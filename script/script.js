new Vue({
  el: '#vueApp',
  data: {
      product: productFromPHP,
      isFavorite: favoriteFromPHP,
      favorite_icon: favoriteFromPHP ? 'fas fa-heart' : 'far fa-heart'
      },
  methods: {
      toggleFavorite() {
          this.isFavorite = !this.isFavorite;
          this.favorite_icon = this.isFavorite ? 'fas fa-heart' : 'far fa-heart';
          

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
