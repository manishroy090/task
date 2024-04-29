import {createContext, useContext, useState} from "react";

const StateContext = createContext({
  User: null,
  token: null,
  notification: null,
  setUser: () => {},
  setToken: () => {},
  setNotification: () => {}
})

export const ContextProvider = ({children}) => {
  const [User, setUser] = useState({
    name:"TestUser"
  });
  const [token, _setToken] = useState(localStorage.getItem('ACCESS_TOKEN'));
  const [notification, _setNotification] = useState('');

  const setToken = (token) => {
    _setToken(token)
    if (token) {
      localStorage.setItem('ACCESS_TOKEN', token);
    } else {
     
    }
  }

  const setNotification = message => {
    _setNotification(message);

    setTimeout(() => {
      _setNotification('')
    }, 5000)
  }

  return (
    <StateContext.Provider value={{
      User,
      setUser,
      token,
      setToken,
      notification,
      setNotification
    }}>
      {children}
    </StateContext.Provider>
  );
}

export const useStateContext = () => useContext(StateContext);