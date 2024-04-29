import axios from 'axios';
import React, { useRef, useState } from 'react'
import axiosClient from '../../axios_client';
import { Link } from 'react-router-dom';
import { useStateContext } from '../context/ContextProvider';

export default function Signup() {
  const nameRef=useRef();
  const emailRef = useRef();
  const passwordRef =useRef();
  const confirmpasswordRef = useRef();
  const {setUser,setToken} = useStateContext();
  const [errors, setErrors] = useState({});

  const handleSubmit=(event)=>{
    event.preventDefault();
    const payload = {
      name:nameRef.current.value,
      email:emailRef.current.value,
      password:passwordRef.current.value,
      password_confirmation:confirmpasswordRef.current.value

    }

    axiosClient.post('auth/register', payload)
    .then(({data}) => {
      const {access_token,user} =data;
      setUser(user);
      setToken(access_token);
    })
    .catch(err => {
      const response = err.response;
      if (response && response.status === 422) {
        setErrors(response.data.errors)
     
      }
    })

  }






  return (

  
     
      <div className="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div className="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 className="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Create and account
              </h1>
              <form className="space-y-4 md:space-y-6" onSubmit={handleSubmit}>
                  <div>
                      <label  htmlFor="name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                      <input ref={nameRef} type="text" name="name" id="name" className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required=""/>
                      <p className='text-red-600'>{errors.name}</p>
                  </div>
                  <div>
                      <label htmlFor="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input ref={emailRef} type="email" name="email" id="email" className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required=""/>
                      <p className='text-red-600'>{errors.email}</p>
                  </div>
                  <div>
                      <label htmlFor="password" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input ref={passwordRef} type="password" name="password" id="password" placeholder="••••••••" className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""/>
                      <p className='text-red-600'>{errors.password}</p>
                  </div>
                  <div>
                      <label htmlFor="confirm-password" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                      <input ref={confirmpasswordRef} type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""/>
                      <p className='text-red-600'>{errors.password}</p>
                  </div>
                 
                  <button type="submit" className="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                  <p className="text-sm font-light text-gray-500 dark:text-gray-400">
                      Already have an account? <Link to="/login" className="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</Link>
                  </p>
              </form>
          </div>
      </div>


      
  
  )
}
