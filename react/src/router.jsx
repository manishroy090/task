import {Navigate, createBrowserRouter} from "react-router-dom";
import Login from "./views/Login";
import Signup from "./views/Signup";
import Notfound from "./views/Notfound";
import DefaultLayout from "./components/DefaultLayout";
import GuestLayout from "./components/GuestLayout";
import Users from "./views/Users";
import Dashboard from "./views/Dashboard";
import Clients from './views/client/Clients';
import ClientsCreate from './views/client/Create';
import ClientDetail from "./views/client/ClientDetail";



const router = createBrowserRouter([
    {
        path:'/',
        element:<DefaultLayout/>,
        children:[
            {
              path:'/',
              element:<Navigate to="/users"/>
            },
            {
                path:'/dashboard',
                element:<Dashboard/>
            },
            {
                path:'/users',
                element:<Users/>
            },

            {
                path:'/clients',
                element:<Clients/>
            },{
                path:'/clients/create',
                element:<ClientsCreate/>
            }
            ,
            {
                path:'/client/detail/:index',
                element:<ClientDetail></ClientDetail>
            }

        ]
    },
    {
        path:'/',
        element:<GuestLayout/>,
        children:[
            {
                path:'/login',
                element:<Login/>
            },{
                path:'/signup',
                element:<Signup/>
            }
        ]
    },
,
{
    path:'/',
    element:<Notfound/>
}
])

export default router
