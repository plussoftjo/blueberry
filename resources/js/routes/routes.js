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
    }
  ]
  
  
  export default routes