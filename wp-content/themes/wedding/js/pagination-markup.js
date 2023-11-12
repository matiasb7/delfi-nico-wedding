/**
 * Generate pagination markup given the total number of pages and the current page.
 *
 * @param {number} totalPages - Total number of pages.
 * @param {number} current - The current active page.
 * @returns {string} - The generated pagination markup.
 */
export default function generatePaginationMarkup(totalPages, current) {
    if (totalPages <= 1) return ''
    const createPageItem = (page) => `
        <li>
            <button class=${`pagination-button ${page === current ? 'current-page' : ''}`} type="button" aria-label="Change page" data-page="${page}">${page}</button>
        </li>`;

    const pages = Array.from({ length: totalPages }, (_, i) => createPageItem(i + 1)).join('');
    return `<ul>${pages}</ul>`;
};
