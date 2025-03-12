import axios from 'axios'

// Check if we're running in a browser environment
const isServer = typeof window === 'undefined'

// For client-side
if (!isServer) {
    window.axios = axios
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
}

// For server-side
export const ssrAxios = axios.create({
    baseURL: import.meta.env.VITE_APP_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    }
})

export default axios
