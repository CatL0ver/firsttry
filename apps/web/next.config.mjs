/** @type {import('next').NextConfig} */
const nextConfig = {
  experimental: {
    typedRoutes: true,
  },
  transpilePackages: ["@crm/ui", "@crm/db"],
};

export default nextConfig;
