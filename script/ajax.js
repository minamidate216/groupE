const app = new Vue({
    //<div id="vueApp">範囲がこのvueの管轄領域にあることを定義
    el:'#vueApp',
    //dataは　vueの中で使われる変数
    data:{
        // 配列の変数を書いておく
        allData: productFromPHP,
    }
    ,created() {
        // idごとに商品を格納するため　後ほどidを使用した処理が出てくるため
        // PHPの連想配列からオブジェクト配列を作成し、それぞれの商品にidを追加する
        this.allData = Object.keys(productFromPHP).map((key) => {
            return {
                id: key,
                ...productFromPHP[key]
            };
        });
    },
    
    methods:{
        // 商品idが該当する商品の個数を減らす
        increment(id) {
        const index = this.getIndexBy(id);
        // 文字列のquantityを数値に変換する
        const quantity = parseInt(this.allData[index].quantity, 10); // 10は基数で、10進数を意味
        if(this.allData[index].count < quantity && this.allData[index].count < 10){
                this.allData[index].count++;
            } 
        },
        // 商品idが該当する商品の個数を減らす
        decrement(id) {
            const index = this.getIndexBy(id);
            if(this.allData[index].count > 0){
                this.allData[index].count--;
            }
        },
        // 商品idを取得する
        getIndexBy(id) {
            const filteredTodo = this.allData.filter(data => data.id === id)[0];
            const index = this.allData.indexOf(filteredTodo);
            return index;
        }
    },
    computed:{
        // 合計金額を返す
        Total(){
            return this.allData.reduce((sum, product) => sum + product.price * product.count, 0);
        }
    }
});
