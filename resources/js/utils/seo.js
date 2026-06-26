export function trimTrailingSlash(value) {
    return typeof value === 'string' ? value.replace(/\/+$/, '') : '';
}

export function absoluteUrl(path, baseUrl = '') {
    if (!path) {
        return undefined;
    }

    if (/^https?:\/\//i.test(path)) {
        return path;
    }

    const base = trimTrailingSlash(baseUrl || '');
    const normalizedPath = path.startsWith('/') ? path : `/${path}`;

    return base ? `${base}${normalizedPath}` : normalizedPath;
}
