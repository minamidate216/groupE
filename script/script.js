new Vue({
    el: '#vueApp',
    data: {
        productId: productFromPHP,
        isFavorite: favoriteFromPHP
        },
    methods: {
        toggleFavorite() {
            this.isFavorite = !this.isFavorite;
            
  
            // API呼び出しでお気に入り状態をサーバーに送信
            axios.post('favorite_api.php', {
                productId: this.productId,  
                isFavorite: this.isFavorite
            })
            .then(response => {
                console.log('お気に入り状態更新:', response.data.status);
                alert(response.data.status);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        },
    }
  });
  


