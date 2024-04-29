import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom';

import VisibilityIcon from '@mui/icons-material/Visibility';
import axiosClient from '../../../axios_client';
import Pagination from '../../components/Pagination'
import { ConstructionOutlined } from '@mui/icons-material';



export default function Clients() {
  const [clients,setClients] = useState([]);
  const [currentpage , setCurrentPage] = useState(1);
  const  [totalPage ,setTotalPage] = useState();

  const fetchData = async (page)=>{
  const response = await axiosClient.get(`clients?page=${page}`);
  const { clients: fetchedClients, pagination } = response.data;
  setClients(fetchedClients);
  setCurrentPage(pagination.current_page);
  setTotalPage(pagination.last_page);
  }

  


  useEffect(()=>{
    fetchData(currentpage);

  },[currentpage]);
 

  const onPageChange =(page)=>{
    setCurrentPage(page);
}

  return (
    <div className="relative overflow-x-auto  sm:rounded-lg bg-gray-100 shadow-xl p-4">
    <div className="flex  justify-end pr-24 ">
      
      <Link to="/customers/create">
        <button
          type="button"
          className="f text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
          Add
        </button>
      </Link>
    </div>
    <table className="w-full text-sm text-left rtl:text-right text-gray-500  ">
      <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
        
          <th scope="col" className="px-6 py-3">
            Sn
          </th>
          <th scope="col" className="px-6 py-3">
            Name
          </th>
          <th scope="col" className="px-6 py-3">
            Email
          </th>
          <th scope="col" className="px-6 py-3">
            Address
          </th>
          <th scope="col" className="px-6 py-3">
          nationality
          </th>
          <th scope="col" className="px-6 py-3">
          Gender
          </th>
          <th scope="col" className="px-6 py-3">
          Phone
          </th>
          <th scope="col" className="px-6 py-3 text-nowrap">
          Date of Birth
          </th>

          <th scope="col" className="px-6 py-3">
            Education
          </th>

          <th scope="col" className="px-6 py-3 text-nowrap">
          contact mode
          </th>

    

          <th scope="col" className="px-6 py-3">
            Action
          </th>
        </tr>
      </thead>
      <tbody>
      {clients.length > 0 ? (
    clients.map((client, index) => (
      <tr key={index}>
           <td className="w-4 p-4">{index+1}</td>
           <td className="w-4 p-4">{client.name}</td>
           <td className="w-4 p-4">{client.email}</td>     
           <td className="w-4 p-4 text-center">{client.address}</td>
           <td className="w-4 p-4 text-center">{client.nationality}</td>
           <td className="w-4 p-4 text-center">{client.gender}</td>
        <td className="w-4 p-4">{client.phone}</td>
        <td className="w-4 p-4 text-center">{client.dob}</td>
        <td className="w-4 p-4">{client.education}</td>
        <td className="w-4 p-4 text-center">{client.contactmode}</td>
        <td className="w-4 p-4">
          <Link
            to={`/client/detail/${index + 1}`}
            className="font-medium text-blue-600 bg-slate-200 p-2 hover:bg-black hover:text-white rounded-md dark:text-blue-500 hover:underline"
          >
            <VisibilityIcon />
          </Link>
        </td>
      </tr>
    ))
  ) : (
    <tr>
      <td colSpan="11" className="w-4 p-12 border text-center text-black font-semibold ">
        No records yet
      </td>
    </tr>
  )}
      
           
      
       
      
       
      </tbody>
    </table>
    <div>
   
    </div>
    <div className="pagination flex overflow-x-auto sm:justify-center p-8">
    <Pagination className="bg-red-600" currentPage={currentpage} totalPage={totalPage} onPageChange={onPageChange}  data={clients}></Pagination>
    </div>
  </div>
  )
}
