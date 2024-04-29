import React from 'react';

const Pagination = ({ currentPage, totalPage, onPageChange,data}) => {


  const handlePageChange = (page) => {
    if (page < 1 || page > totalPage ) return;
    onPageChange(page);
  };

  // Check if totalPage is greater than 1 before rendering the pagination
  if (totalPage <= 1 || data.length ===0) return null;

  return (
    <nav aria-label="Page navigation example">
      <ul className="list-style-none flex space-x-1">
        <li onClick={() => handlePageChange(currentPage - 1)}>
          <button
            disabled={currentPage === 1}
            className="relative  rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 text-black  focus:bg-neutral-100 focus:text-primary-700 focus:outline-none focus:ring-0  active:text-primary-700  dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:focus:text-primary-500 dark:active:bg-neutral-700 dark:active:text-primary-500"
            href="#"
          >
            Previous
          </button>
        </li>
        {Array.from({ length: totalPage }, (_, i) => i + 1).map((page) => (
          <li key={page} onClick={() => handlePageChange(page)}>
            <button
              className={page === currentPage ? 'relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 focus:text-white hover:hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:focus:text-primary-500 dark:active:bg-neutral-700 dark:active:text-primary-500' : 'relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:hover:bg-blue-600 hover:text-white focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:focus:text-primary-500 dark:active:bg-neutral-700 dark:active:text-primary-500'}
            >
              {page}
            </button>
          </li>
        ))}
        <li onClick={() => handlePageChange(currentPage + 1)}>
          <button
            disabled={currentPage === totalPage}
            className="relative  block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300  focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:focus:text-primary-500 dark:active:bg-neutral-700 dark:active:text-primary-500"
            href="#"
          >
            Next
          </button>
        </li>
      </ul>
    </nav>
  );
};

export default Pagination;