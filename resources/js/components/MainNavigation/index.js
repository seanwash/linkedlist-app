import React, { useRef } from 'react';
import userCurrentUser from '../../hooks/userCurrentUser';
import { useClickAway } from 'react-use';
import { Link } from '@inertiajs/inertia-react';
import constants from '../../constants';

const MainNavigation = (props) => {
  const user = userCurrentUser();
  const [userMenuOpen, setUserMenuOpen] = React.useState(false);

  const menuRef = useRef(null);
  useClickAway(menuRef, () => setUserMenuOpen(false));

  return (
    <nav className="bg-white border-b border-gray-100">
      {/* Primary Navigation Menu */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between h-16">
          <div className="flex">
            {/* Logo */}
            <div className="flex-shrink-0 flex items-center">
              <Link href={constants.routes.HOME}>
                <span className="flex items-center block h-10 w-auto fill-current text-gray-600">
                  🧬{' '}
                  <span className="inline-block ml-2 text-sm font-semibold text-gray-900">
                    LinkedList
                  </span>
                </span>
              </Link>
            </div>

            {/* Navigation Links */}
            <div className="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <Link
                className="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out"
                href={constants.routes.HOME}
              >
                Notes
              </Link>
            </div>
          </div>

          {/* Settings Dropdown */}
          <div className="hidden sm:flex sm:items-center sm:ml-6">
            <div className="relative">
              <div>
                <button
                  type="button"
                  onClick={() => setUserMenuOpen(!userMenuOpen)}
                  className="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                >
                  <div>{user?.email}</div>
                  <div className="ml-1">
                    <svg
                      className="fill-current h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fillRule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clipRule="evenodd"
                      />
                    </svg>
                  </div>
                </button>
              </div>
              {userMenuOpen && (
                <div
                  ref={menuRef}
                  className="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                >
                  <div className="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                    {/* Authentication */}
                    <form method="POST" action="https://linkedlist.test/logout">
                      <input
                        type="hidden"
                        name="_token"
                        defaultValue="V1HI85gGuQvwOJ40dxwkFYKVD9Z3MlO8OZCMsZdU"
                      />
                      <a
                        className="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                        href="https://linkedlist.test/logout"
                      >
                        Log Out
                      </a>
                    </form>
                  </div>
                </div>
              )}
            </div>
          </div>

          {/* Hamburger */}
          <div className="-mr-2 flex items-center sm:hidden">
            <button className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
              <svg
                className="h-6 w-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  className="inline-flex"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  className="hidden"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      {/* Responsive Navigation Menu */}
      <div className="hidden sm:hidden">
        <div className="pt-2 pb-3 space-y-1">
          <a
            className="block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out"
            href="https://linkedlist.test/n"
          >
            Notes
          </a>
        </div>
        {/* Responsive Settings Options */}
        <div className="pt-4 pb-1 border-t border-gray-200">
          <div className="px-4">
            <div className="font-medium text-base text-gray-800" />
            <div className="font-medium text-sm text-gray-500">
              {user?.email}
            </div>
          </div>
          <div className="mt-3 space-y-1">
            {/* Authentication */}
            <form method="POST" action="https://linkedlist.test/logout">
              <input
                type="hidden"
                name="_token"
                defaultValue="V1HI85gGuQvwOJ40dxwkFYKVD9Z3MlO8OZCMsZdU"
              />
              <a
                className="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                href="https://linkedlist.test/logout"
              >
                Log Out
              </a>
            </form>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default MainNavigation;
