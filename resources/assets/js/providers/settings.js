export default {
  getCategories() {
    return fetch('/api/admin/settings/categories').then(response => {
      if (response.status !== 200) {
        return console.error("API responded code " + response.status)
      }

      return response.json()
    }).then(data => {
      if (data.error) {
        throw new Error(data.error);
      }

      return data;
    })
  }
}
