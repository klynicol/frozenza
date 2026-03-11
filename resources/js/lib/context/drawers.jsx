'use client';
import { createContext, useContext, useState, useCallback, useMemo } from "react";

const DrawerContext = createContext(null);

export const DrawerProvider = ({ children }) => {

  const [drawers, setDrawers] = useState({});

  const toggleDrawer = useCallback((name) => {
    setDrawers((prev) => ({ ...prev, [name]: !prev[name] }));
  }, []);

  const value = useMemo(() => ({
    drawers,
    toggleDrawer,
  }), [drawers, toggleDrawer]);

  return (
    <DrawerContext.Provider value={value}>
      {children}
    </DrawerContext.Provider>
  );
};

export const useDrawer = () => {
  const context = useContext(DrawerContext);
  if (!context) {
    throw new Error("useDrawer must be used within a DrawerProvider");
  }
  return context;
};
