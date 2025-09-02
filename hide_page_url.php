<script>
  function generateRandomSlug(length = 12) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let slug = '';
    for (let i = 0; i < length; i++) {
      slug += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return slug;
  }

  const randomSlug = generateRandomSlug();

  let path = window.location.pathname;

  // Check if URL ends with a filename (something with extension)
  if (/\.[^\/]+$/.test(path)) {
    // Remove the filename part (everything after last slash including slash)
    path = path.replace(/\/[^\/]+$/, '');
  }

  // Ensure path ends with a slash before adding slug
  if (!path.endsWith('/')) {
    path += '/';
  }

  // New URL with random slug appended
  const newUrl = window.location.origin + path + randomSlug;

  // Update URL in the browser without reloading the page
  window.history.replaceState({}, '', newUrl);
</script>
