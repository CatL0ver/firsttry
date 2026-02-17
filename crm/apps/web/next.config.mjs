/** @type {import('next').NextConfig} */
const nextConfig = {
  output: "standalone",
  experimental: {
    typedRoutes: true,
  },
  transpilePackages: ["@crm/ui", "@crm/db"],
};

export default nextConfig;
