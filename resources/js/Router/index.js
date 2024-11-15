
import { createRouter, createWebHistory } from "vue-router";

import Login from "../Pages/Login.vue";
import Register from "../Pages/Register.vue";
// import Store from "../Pages/Store.vue";
// import Pos from "../Pages/Pos.vue";
// import Transection from "../Pages/Transection.vue";
// import Report from "../Pages/Report.vue";
// import NoPage from "../Pages/NoPage.vue";
import { useStore } from "../Store/auth";

// created meddleware

const authMiddleware = (to, from , next) => {

  const token = localStorage.getItem('web_token');
  const user = localStorage.getItem('web_user');
  const store = useStore();

  if(token){
      // ຖ້າມີ token ໃນ localstorage ເກັບໄວ້ໃນ pinia
      store.set_token(token);
      store.set_user(user);
      next();
  } else {
      // console.log('Go to login')
      // ບໍ່ມີ token
      next({
          path:'/login',
          replace: true
      })
  }

}

export const routes = [
    {
      name:'root',
      path:'/',
      redirect:'/store'
    },
    {
      name: 'login',
      path: '/login',
      component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
      },
      {
        name: 'store',
        path: '/store',
        component: ()=> import('../Pages/Store.vue'),
        meta: {
            middleware: [authMiddleware]
        }
      },
      {
        name: 'pos',
        path: '/pos',
        component: ()=> import('../Pages/Pos.vue'),
        meta: {
            middleware: [authMiddleware]
        }
      },
      {
        name: 'transection',
        path: '/transection',
        component: ()=> import('../Pages/Transection.vue'),
        meta: {
            middleware: [authMiddleware]
        }
      },
      {
        name: 'report',
        path: '/report',
        component: ()=> import('../Pages/Report.vue'),
        meta: {
            middleware: [authMiddleware]
        }
      },
      {
        name: 'nopage',
        path: '/:pathMacth(.*)*',
        component: ()=> import('../Pages/NoPage.vue'),
        meta: {
            middleware: [authMiddleware]
        }
      }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior(){
        window.scrollTo(0,0)
    }
});



router.beforeEach((to,from,next)=>{
    
  const token = localStorage.getItem('web_token');

  if(to.meta.middleware){
      to.meta.middleware.forEach(middleware=>middleware(to,from,next))
  } else {
      if(to.path == '/login' || to.path == '/'){
          if(token){
              next({
                  path:'/store',
                  replace: true
              })
          } else {
              next();
          }
      } else {
          next();
      }
  }
});


export default router;