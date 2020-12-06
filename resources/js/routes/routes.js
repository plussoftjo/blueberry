import DeliverFee from '../Screens/DeliverFee.vue'
import GoodsBasket from '../Screens/GoodsBasket.vue'
import Order from '../Screens/Order.vue';
import OrderShow from '../Screens/OrderShow.vue'

const routes = [
    {
      path: '/',
      component: Order,
      name:'Order'
    },
    {
      path:'/OrderShow/:id',
      component:OrderShow,
      name:'OrderShow'
    },
    {
      path:'/goodsbasket',
      component:GoodsBasket,
      name:'GoodsBasket'
    },
    {
      path:'/deliverfee',
      component:DeliverFee,
      name:'DeliverFee'
    }
  ]
  
  
  export default routes