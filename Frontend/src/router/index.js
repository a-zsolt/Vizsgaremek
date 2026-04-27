import { createRouter, createWebHistory } from 'vue-router'

const PublicLayout = () => import('@/components/layout/PublicLayout.vue')
const AuthLayout = () => import('@/components/layout/AuthLayout.vue')
const AppLayout = () => import('@/components/layout/AppLayout.vue')

const routes = [
  {
    path: '/',
    component: PublicLayout,
    children: [
      {
        path: '',
        name: 'home',
        component: () => import('@/views/public/HomeView.vue'),
        meta: { title: 'Home' }
      },
      {
        path: 'models/:model',
        name: 'model',
        component: () => import('@/views/public/ModelView.vue'),
        meta: { title: 'Model' },
      },
      {
        path: 'models/:model/configure',
        name: 'configure',
        component: () => import('@/views/public/ConfigView.vue'),
        meta: { title: 'Configure', requiresAuth: true }
      }
    ]
  },
  {
    path: '/auth',
    component: AuthLayout,
    children: [
      {
        path: 'login',
        name: 'login',
        component: () => import('@/views/auth/LoginView.vue'),
        meta: {
          title: 'Login',
          guestOnly: true
        }
      },
      {
        path: 'register',
        name: 'register',
        component: () => import('@/views/auth/RegisterView.vue'),
        meta: { title: 'Register' }
      }
    ]
  },
  {
    path: '/app',
    component: AppLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        redirect: { name: 'profile' }
      },
      {
        path: 'profile',
        name: 'profile',
        component: () => import('@/views/app/ProfileView.vue'),
        meta: { title: 'Profile' },
        children: [
          {
            path: 'details',
            name: 'profile-details',
            component: () => import('@/views/app/ProfileDetailsView.vue'),
            meta: { title: 'Profile Details' }
          },
          {
            path: 'orders',
            name: 'orders-list',
            component: () => import('@/views/app/OrderListView.vue'),
            meta: { title: 'Orders' },
          },
          {
            path: 'orders/:order',
            name: 'order-details',
            component: () => import('@/views/app/OrderDetailsView.vue'),
            meta: { title: 'Order Details' }
          },
          {
            path: 'configs',
            name: 'configs-list',
            component: () => import('@/views/app/SavedConfigsView.vue'),
            meta: { title: 'Configure' }
          }
        ]
      },
      {
        path: 'admin',
        meta: { roles: ['admin'] },
        children: [
          {
            path: '',
            redirect: { name: 'dashboard' }
          },
          {
            path: 'dashboard',
            name: 'dashboard',
            component: () => import('@/views/app/admin/DashboardView.vue'),
            meta: { title: 'Dashboard', roles: ['admin'] },
              children: [
                  {
                      path: 'users',
                      name: 'users-list',
                      component: () => import('@/views/app/admin/AdminUserView.vue'),
                      meta: { title: 'Users', roles: ['admin'] }
                  },
                  {
                      path: 'users/:user',
                      name: 'user-details',
                      component: () => import('@/views/app/admin/AdminUserDetailsView.vue'),
                      meta: { title: 'User Details', roles: ['admin'] },
                      props: route => ({ id: route.params.user }),
                  },
                  {
                      path: 'orders',
                      name: 'orders',
                      component: () => import('@/views/app/admin/AdminOrderListView.vue'),
                      meta: { title: 'Orders', roles: ['admin'] }
                  },
                  {
                      path: 'orders/:order',
                      name: 'admin-order-details',
                      component: () => import('@/views/app/admin/AdminOrderDetailsView.vue'),
                      meta: { title: 'Order', roles: ['admin']},
                      props: route => ({ id: route.params.order }),
                  }
              ],
          },
        ]
      }
    ]
  },
  {
    path: '/403',
    name: 'not-authorized',
    component: () => import('@/views/errors/NotAuthorizedView.vue'),
    meta: { title: 'Not Authorized' }
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: () => import('@/views/errors/NotFoundView.vue'),
    meta: { title: 'Not Found' }
  }
]


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,

})

function isLoggedIn() {
  return !!localStorage.getItem('token');
}

function getAbilities() {
  try {
    return JSON.parse(localStorage.getItem('abilities')) || []
  } catch {
    return []
  }
}

function hasRole(roles) {
  const abilities = getAbilities()
  return roles.some(role => abilities.includes(role))
}

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(r => r.meta.requiresAuth)
  const guestOnly = to.matched.some(r => r.meta.guestOnly)
  const requiredRoles = to.matched.map(r => r.meta.roles).find(r => r)

  // Not logged in > redirect to login
  if (requiresAuth && !isLoggedIn()) {
    return next({ name: 'login', query: { redirect: to.fullPath } })
  }

  // Logged in but trying to access guest-only page (login/register)
  if (guestOnly && isLoggedIn()) {
    return next({ name: 'home' })
  }

  // Logged in but wrong role > 403a
  if (requiredRoles && !hasRole(requiredRoles)) {
    return next({ name: 'not-authorized' })
  }

  return next()
})

router.afterEach(to=>{
  const defaultTitle = 'Porsche';
  const nearsWithTitle  = to.matched.slice().reverse().find(r => r.meta && r.meta.title);
  if(nearsWithTitle){
    document.title = `${nearsWithTitle.meta.title} | ${defaultTitle}`;
  }
  else {
    document.title = `${defaultTitle}`;
  }
})

export default router
