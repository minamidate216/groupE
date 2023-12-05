new Vue({
  el: '#vueApp',
  data: {
      product: productFromPHP,
      isFavorite: favoriteFromPHP
      },
  methods: {
      toggleFavorite() {
          this.isFavorite = !this.isFavorite;
          

          // API呼び出しでお気に入り状態をサーバーに送信
          axios.post('favorite_api.php', {
              productId: this.product,
              isFavorite: this.isFavorite
          })
          .then(response => {
              console.log('お気に入り状態更新:', response.data);
          })
          .catch(error => {
              console.error('Error:', error);
          });
      },

  }
});
