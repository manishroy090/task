import React ,{useEffect, useState} from "react";
import { useParams } from 'react-router-dom';
import axiosClient from "../../../axios_client";
export default function ClientDetails(){
  const {index} = useParams();
  const [clientDetails ,setClientDetials] = useState({});
  const fetchData = async (page)=>{
    const response = await axiosClient.get(`clients/${index}`);
    const {clientDetails} = response.data;
    setClientDetials(clientDetails);
  
    }
    useEffect(()=>{
      fetchData();
    },[]);
 

  
    return(
      <>
      <div className="m-32">
      <h1 className="text-4xl text-left">Clients Details</h1>
      <div className="flex flex-col space-y-3 mt-8 text-left">
      <span><strong>Name: </strong>    {clientDetails.name}</span>
      <span><strong>Email:</strong>  {clientDetails.email}</span>
      <span><strong>Address</strong> {clientDetails.address}</span>
      <span><strong>Nationality:</strong> {clientDetails.nationality}</span>
      <span><strong>Gender:</strong> {clientDetails.gender}</span>
      <span><strong>Phone:</strong> {clientDetails.phone}</span>
      <span><strong>Date of Birth:</strong> {clientDetails.dob}</span>
      <span><strong>Education:</strong> {clientDetails.education}</span>
      <span><strong>Contactmode:</strong> {clientDetails.contactmode}</span>
      </div>
      </div>
      </>
    )
}