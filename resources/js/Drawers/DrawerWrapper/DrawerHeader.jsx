//import IconBtn from '@modules/components/buttons/IconButton';
import CloseIcon from '@mui/icons-material/Close';

const DrawerHeader = ({
  name,
  title = null,
  toggleDrawer,
}) => {
  
  return (
    <header className="flex flex-col border-b p-4">
      <div className="self-end">
        {/* <IconBtn
          size='small'
          shape='round'
          icon={<CloseIcon />}
          drawer={name}
        /> */}
      </div>
      {
        title &&
        <div>
          {title}
        </div>
      }
    </header>
  );
};

export default DrawerHeader;