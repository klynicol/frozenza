// Helper function to generate routes
// Example: route('blogs.index') => /blogs
// Example: route('blogs.show', { slug: 'my-blog-post' }) => /blogs/my-blog-post
// Example: route('blogs.edit', { id: 1 }) => /blogs/1/edit
// Example: route('blogs.create') => /blogs/create
// Example: route('blogs.store') => /blogs
// Example: route('blogs.update', { id: 1 }) => /blogs/1
// Example: route('blogs.destroy', { id: 1 }) => /blogs/1

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