// Ensure user has at least one of the roles
export const hasRole = (user: any, role: string) => {
   if(!user?.roles) return false;
   const roles = role.split(',');
   return user.roles.some((r: any) => roles.includes(r.code));
};