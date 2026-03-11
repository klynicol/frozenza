'use client';
import { createContext, useContext, useState, useEffect } from 'react';

const CustomerContext = createContext(null);

export const CustomerProvider = ({
  theCustomer,
  children
}) => {

  const [customer, setCustomer] = useState(theCustomer);
  const [showLogin, setShowLogin] = useState(true);

  // useEffect(() => (
  //   console.log(customer)
  // ),[customer]);

  return (
    <CustomerContext.Provider value={{
      customer,
      setCustomer,
      showLogin,
      setShowLogin
    }}>
      {children}
    </CustomerContext.Provider>
  );
};

export const useCustomer = () => {
  return useContext(CustomerContext);
};
