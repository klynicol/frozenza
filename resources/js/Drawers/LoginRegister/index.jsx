'use client';
import { useDrawer } from '@lib/context/drawers';
import DrawerWrapper from '@modules/components/drawers/DrawerWrapper';

const LoginRegister = () => {

  const { drawers } = useDrawer();
  const drawerName= ('loginRegister');

  return (
    <DrawerWrapper
      name={drawerName}
      isOpen={drawers[drawerName]}
      direction={'right'}
    >
      <div className="p-4">
        
      </div>
    </DrawerWrapper>
  );
};

export default LoginRegister;