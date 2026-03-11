'use client';
import {
  createContext,
  useContext,
  useState,
  useCallback,
  useMemo
} from "react";

const ModalContext = createContext(null);

export const ModalProvider = ({ children }) => {

  const [modal, setModal] = useState({});
  const [modalData, setModalData] = useState({});

  const toggleModal = useCallback((name) => {
    setModal((prev) => ({ ...prev, [name]: !prev[name] }));
  }, []);

  const value = useMemo(() => ({
    modal,
    toggleModal,
    modalData,
    setModalData
  }), [modal, toggleModal]);

  return (
    <ModalContext.Provider value={value}>
      {children}
    </ModalContext.Provider>
  );
};

export const useModal = () => {
  const context = useContext(ModalContext);
  if (!context) {
    throw new Error("useModal must be used within a ModalProvider");
  }
  return context;
};
