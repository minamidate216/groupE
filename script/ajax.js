// 金額が変更されるメソッドを追加する
// 個数が変更された際に次のページに渡されていない

const app = new Vue({
    //<div id="vueApp">範囲がこのvueの管轄領域にあることを定義
    el:'#vueApp',
    //dataは　vueの中で使われる変数
    data:{
        message :'',
        // 配列の変数を書いておく
        allData:productFromPHP,
        subTotal : 0,
        total:0
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
        increment(id) {
        const index = this.getIndexBy(id);
        // 文字列のquantityを数値に変換する
        const quantity = parseInt(this.allData[index].quantity, 10); // 10は基数で、10進数を意味
        if(this.allData[index].count < quantity){
                this.allData[index].count++;
            } else {
                this.message = `商品ID ${id} の在庫が不足しています。`;
            }
        },
        decrement(id) {
            const index = this.getIndexBy(id);
            if(this.allData[index].count > 0){
                this.allData[index].count--;
            }
        },
        getIndexBy(id) {
            const filteredTodo = this.allData.filter(data => data.id === id)[0];
            const index = this.allData.indexOf(filteredTodo);
            return index;
        }
    },

});
// ここから先は元々のコード
// const app = new Vue({
//     //<div id="vueApp">範囲がこのvueの管轄領域にあることを定義
//     el:'#vueApp',
//     //dataは　vueの中で使われる変数
//     data:{
//         allData:[
//             {id:1, name:"abc", price:400, count:0},
//             {id:2, name:"def", price:300, count:0},
//             {id:3, name:"ghi", price:500, count:0},
//         ],
//     },
//     methods:{
//         increment(id) {
//             const index = this.getIndexBy(id);
//             this.allData[index].count++;
//         },
//         decrement(id) {
//             const index = this.getIndexBy(id);
//             this.allData[index].count--;
//         },
//         getIndexBy(id) {
//             const filteredTodo = this.allData.filter(data => data.id === id)[0];
//             const index = this.allData.indexOf(filteredTodo);
//             return index;
//         }

//     },

// });