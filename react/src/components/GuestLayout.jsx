import React from 'react';
import { Outlet } from 'react-router-dom';
import { useStateContext } from '../context/ContextProvider';
import { Navigate} from 'react-router-dom';

export default function GuestLayout() {
  const {token} =useStateContext();
  
  if(token){
    return <Navigate to="/"/>
  }
  return (
    <div className=" w-screen   flex  justify-center">
        <Outlet/>
    </div>
  )
}
