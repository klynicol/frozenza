export function route(name: string, params?: string | Record<string, string | number>): string {
    // If params is a string, treat it as a slug
    if (typeof params === 'string') {
        return `/${name.replace('.', '/')}/${params}`;
    }
    
    // Handle object params
    if (!params) return `/${name.replace('.', '/')}`;
    
    const path = name.replace('.', '/');
    const queryParams = new URLSearchParams();
    Object.entries(params).forEach(([key, value]) => {
        queryParams.append(key, String(value));
    });
    
    return `/${path}${queryParams.toString() ? `?${queryParams.toString()}` : ''}`;
} 