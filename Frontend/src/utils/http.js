import axios from 'axios'

// Axios instance preconfigured for API base URL and JSON headers
export const http = axios.create({
    baseURL: "http://localhost:8000/",
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    }
})

// Attach Bearer token from localStorage to every outgoing request
http.interceptors.request.use(config => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})
