/** @type {import('tailwindcss').Config} */

const { join } = require('path');

module.exports = {
  content: [join(__dirname, './assets/**/*.js'), 
           join(__dirname, './templates/**/*.html.twig')],
//    "./assets/**/*.js",
//    "./templates/**/*.html.twig",
//  ],
  theme: {
    extend: {},
  },
  plugins: [require("tailwindcss")],

  safelist: [
    'flex', 'items-center', 'justify-between', 'flex-1', 'z-0', 'inline-flex', 'shadow-sm',
    'relative', 'px-4', 'py-2', 'text-sm', 'font-medium', 
    'text-gray-500', 'text-gray-700', 'bg-white', 
    'border', 'border-gray-300', 'cursor-default', 
    'rounded-l-md', 'rounded-r-md', '-ml-px',
    'hover:text-gray-500', 'focus:z-10', 'focus:outline-none', 
    'focus:border-blue-300', 'focus:shadow-outline-blue', 
    'active:bg-gray-100', 'active:text-gray-700', 
    'transition', 'ease-in-out', 'duration-150'
  ],
}
