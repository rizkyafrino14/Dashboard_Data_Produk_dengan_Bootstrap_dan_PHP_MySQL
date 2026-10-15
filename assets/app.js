document.addEventListener('DOMContentLoaded', () => {
  const search = document.querySelector('#productSearch');
  if (!search) return;
  search.addEventListener('input', (event) => {
    const query = event.target.value.trim().toLowerCase();
    document.querySelectorAll('[data-product-row]').forEach((row) => {
      row.classList.toggle('d-none-row', query && !row.textContent.toLowerCase().includes(query));
    });
  });
});
