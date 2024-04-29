import React, { useState } from 'react'
import axiosClient from '../../../axios_client';
import { useFormik } from 'formik';
import {clientSchema} from '../../schemas/index';
import { useNavigate } from 'react-router-dom';
export default function Create() {
  const navigate = useNavigate();
  const [backendErrorList, setErrors] = useState ({});
  const initialValues ={
    name:'',
    email:'',
    address:'',
    nationality:'',
    gender:"",
    phone:"",
    dob:"",
    education:"",
    contactmode:""
  }

  const {values,errors,handleBlur,touched,handleChange,handleSubmit} = useFormik({
    initialValues:initialValues,
    validationSchema:clientSchema,
    onSubmit : (values)=>{
       axiosClient.post('clients',values).then(({data})=>{
        navigate('/login');
        }) .catch(err => {
        const response = err.response;
        if (response && response.status === 422) {
          setErrors(response.data.errors)
        }
        })
    }
  })

  



  


  
  return (
    <div>
       <form className="max-w-fit  mx-auto shadow-xl border-none rounded-md" onSubmit={handleSubmit}>
          <h4 className="text-xl  dark:text-white bg-blue-600 w-full border-none px-8 rounded-t text-white p-1">
            Create
          </h4>
          <div className=" flex flex-col space-y-8 p-8">
            <div className="lg:flex flex-col sm:flex-row  lg:space-x-40">
              <div className="mb-5">
                <label
                  htmlFor="name"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Name
                </label>
                <input
                  onChange={handleChange}
                  onBlur={handleBlur}
                  value={values.name}
                  name="name"
                  type="text"
                  id="name"
                  className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                <p className='text-red-600'>{errors.name && touched.name? errors.name : backendErrorList.name || ''}</p>
              </div>

              <div className="mb-5">
                <label
                  htmlFor="email"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Email
                </label>
                <input
                  onChange={handleChange}
                  onBlur={handleBlur}
                  value={values.email}
                  name="email"
                  type="email"
                  id="email"
                  className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                         <p className='text-red-600'>{errors.email && touched.email ? errors.email :  backendErrorList.email || ''}</p>
              </div>

              <div className="mb-5">
                <label
                  htmlFor="address"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Address
                </label>
                <input
                  onChange={handleChange}
                  onBlur={handleBlur}
                  value={values.address}
                  name="address"
                  type="text"
                  id="large-input"
                  className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                      <p className='text-red-600'>{errors.address && touched.address ? errors.address :   backendErrorList.address || ''}</p>
              </div>

            
            </div>


            <div className="lg:flex flex-col sm:flex-row  lg:space-x-40">
              <div className="mb-5">
                <label
                  htmlFor="nationality"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Nationality
                </label>
                <input
                  onChange={handleChange}
                  onBlur={handleBlur}
                  value={values.nationality}
                  name="nationality"
                  type="text"
                  id="large-input"
                  className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                <p className='text-red-600'>{errors.nationality && touched.nationality ? errors.nationality :  backendErrorList.nationality || ''}</p>
              </div>

              <div className="mb-5">
              <label
                htmlFor="gender"
                className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >
                Gender
              </label>
              <select
              
                name="gender"
                onChange={handleChange}
                value={values.gender}
                onBlur={handleBlur}
                id="gender"
                className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              >
                <option selected>Choose Gender</option>
                 <option value="male">Male</option>
                 <option value="female">Female</option>
              </select>
              <p className='text-red-600'>{errors.gender && touched.gender ? errors.gender :   backendErrorList.gender || ''}</p>
              </div>

              <div className="mb-5">
                <label
                  htmlFor="phone"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Phone
                </label>
                <input
                  onChange={handleChange}
                  onBlur={handleBlur}
                  value={values.phone}
                  name="phone"
                  type="text"
                  id="phone"
                  className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                  <p className='text-red-600'>{errors.phone && touched.phone ? errors.phone :  backendErrorList.gender || ''}</p>
              </div>

            
            </div>


            <div className="lg:flex flex-col sm:flex-row  lg:space-x-40">
              <div className="mb-5">
                <label
                  htmlFor="dob"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Date of Birth
                </label>
                <input
                  onChange={handleChange}
                  onBlur={handleBlur}
                  value={values.dob}
                  name="dob"
                  type="date"
                  id="dob"
                  className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                  <p className='text-red-600'>{errors.dob && touched.dob ? errors.dob : backendErrorList.dob || ''}</p>
              </div>

              <div className="mb-5">
              <label
                htmlFor="education"
                className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >
                Education
              </label>
              <select
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.education}
                name="education"
                id="education"
                className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              >
                <option selected>Choose Education</option>
                 <option value="No Schooling">No Schooling</option>
                 <option value="some_high_school">Some High School or Less</option>
                 <option value="high_School_graduate">High School Graduate</option>
                 <option value="some_collage">Some Collage</option>
                 <option value="associate_degree">Associate Degree</option>
                 <option value="bachelor_Degree">Bachelor's Degree</option>
                 <option value="some_Graduate_Degree">Some Graduate Degree</option>
                 <option value="master_degree">Master's Degree</option>
                 <option value="doctoral_degree">Doctoral Degree</option>
               
  
              </select>
              <p className='text-red-600'>{errors.education && touched.education ? errors.education :  backendErrorList.dob || ''}</p>
              </div>

              <div className="mb-5">
              <label
                htmlFor="contactmode"
                className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >
                Contact Mode
              </label>
              <select
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.contactmode}
                name="contactmode"
                id="contactmode"
                className="block w-96 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              >
                <option selected>Choose a contact mode</option>
                 <option value="email">Email</option>
                 <option value="phone">Phone</option>
                 <option value="phone">None</option>
               
  
              </select>
              <p className='text-red-600'>{errors.contactmode && touched.errors ? errors.contactmode : backendErrorList.contactmode || ''}</p>
              </div>

            
            </div>
         
         

         

            
            <div className="flex">
              <button
                type="submit"
                className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              >
                Submit
              </button>
              <button
                type="button"
                className="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              >
                Cancel
              </button>
            </div>
          </div>
        </form>
      
    </div>
  )
}