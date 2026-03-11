import { ModalProvider } from './modals';
import { DrawerProvider } from './drawers';

const Contexts = ({
  children
}) => {
  return (
    <ModalProvider>
      <DrawerProvider>
        {children}
      </DrawerProvider>
    </ModalProvider>
  );
}

export default Contexts;
