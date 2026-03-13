import { Link } from '@inertiajs/react';
import clsx from 'clsx';
import { Theme as t } from './theme';
import Client from '../client';

const Button = ({
  component: Component = 'button',
  startIcon = null,
  endIcon = null,
  size = 'medium',
  variant = 'text',
  shape = 'rounded',
  color = 'plain',
  disabled = false,
  loading = false,
  children,
  drawer,
  modal,
  modalData,
  transition,
  navigateTo,
  ...props
}) => {

  const isButton = Component === 'button';

  return (
    <Component
      onClick={props.onClick}
      className={clsx(
        t.base,
        t.sizes.buttonSize[size],
        t.shapes[shape],
        t.variants[variant].base,
        t.variants[variant].colors[color],
        props.className
      )}>
      {startIcon &&
        <i className={clsx(t.sizes.iconSize[size],)}>{startIcon}</i>
      }
      {
        children &&
        <span>{children}</span>
      }
      {
        endIcon &&
        <i className={clsx(t.sizes.iconSize[size],)}>{endIcon}</i>
      }
      {isButton && (
        <Client
          drawer={drawer || undefined}
          modal={modal || undefined}
          modalData={modalData || undefined}
          navigateTo={navigateTo || undefined}
          transition={transition || undefined}
        />
      )}
    </Component>
  );
}

export default Button;