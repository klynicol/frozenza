import React, { useState, useRef, useEffect } from 'react';
import { ChevronDownIcon, ChevronRightIcon } from '@heroicons/react/20/solid';

export default function MultiLevelPizzaDropdown({ 
  pizzas, 
  selectedPizzaId,
  onChange,
  placeholder = "Select a pizza",
  className = "",
  required = false,
  hasError = false
}) {
  console.log(pizzas);
  const [isOpen, setIsOpen] = useState(false);
  const [openBrandId, setOpenBrandId] = useState(null);
  const dropdownRef = useRef(null);
  
  // Group pizzas by brand
  const groupedPizzas = pizzas.reduce((groups, pizza) => {
    const brandName = pizza.brand?.name || 'Other';
    const brandId = pizza.brand?.id || 'other';
    
    if (!groups[brandId]) {
      groups[brandId] = {
        name: brandName,
        id: brandId,
        pizzas: []
      };
    }
    groups[brandId].pizzas.push(pizza);
    return groups;
  }, {});
  
  // Create sorted array of brand objects
  const brands = Object.values(groupedPizzas).sort((a, b) => a.name.localeCompare(b.name));
  
  // Find the selected pizza and its brand
  const selectedPizza = pizzas.find(pizza => pizza.id === selectedPizzaId);
  
  // Handle clicking outside to close dropdown
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setIsOpen(false);
        setOpenBrandId(null);
      }
    };
    
    document.addEventListener('mousedown', handleClickOutside);
    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
    };
  }, []);
  
  const toggleDropdown = () => {
    setIsOpen(!isOpen);
    if (isOpen) {
      setOpenBrandId(null);
    }
  };
  
  const toggleBrandDropdown = (e, brandId) => {
    e.stopPropagation();
    setOpenBrandId(openBrandId === brandId ? null : brandId);
  };
  
  const handlePizzaSelect = (e, pizzaId) => {
    e.preventDefault();
    onChange(pizzaId);
    setIsOpen(false);
    setOpenBrandId(null);
  };

  const clearSelection = (e) => {
    e.preventDefault();
    onChange('');
    setIsOpen(false);
  };

  const getButtonDisplayText = () => {
    if (selectedPizza) {
      return `${selectedPizza.name} (${selectedPizza.brand?.name || 'Unknown Brand'})`;
    }
    return placeholder;
  };
  
  return (
    <div className={`relative ${className}`} ref={dropdownRef}>
      <button 
        id="pizzaDropdownButton" 
        data-dropdown-toggle="pizza-dropdown" 
        className={`w-full text-left ${hasError ? 'border-red-500' : 'border-gray-300'} 
          bg-white hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 
          font-medium rounded-lg text-sm px-4 py-2.5 inline-flex items-center justify-between
          border shadow-sm`}
        type="button"
        onClick={toggleDropdown}
      >
        {getButtonDisplayText()}
        <ChevronDownIcon className="w-4 h-4 ms-3" />
      </button>

      {/* Dropdown menu */}
      {isOpen && (
        <div id="pizza-dropdown" className="z-10 absolute mt-1 w-full bg-white divide-y divide-gray-100 rounded-lg shadow-lg">
          <ul className="py-2 text-sm text-gray-700" aria-labelledby="pizzaDropdownButton">
            {selectedPizzaId && (
              <li>
                <a 
                  href="#" 
                  className="block px-4 py-2 hover:bg-gray-100 font-medium text-indigo-600"
                  onClick={clearSelection}
                >
                  Clear selection
                </a>
              </li>
            )}
            
            {brands.map((brand) => (
              <li key={brand.id}>
                <button 
                  id={`brand-${brand.id}-button`} 
                  data-dropdown-toggle={`brand-${brand.id}-dropdown`}
                  data-dropdown-placement="right-start" 
                  type="button" 
                  className="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100"
                  onClick={(e) => toggleBrandDropdown(e, brand.id)}
                >
                  {brand.name}
                  <ChevronRightIcon className="w-4 h-4 ms-3" />
                </button>
                
                {openBrandId === brand.id && (
                  <div 
                    id={`brand-${brand.id}-dropdown`}
                    className="z-10 bg-white border border-gray-200 rounded-lg shadow-lg w-full ml-2"
                    style={{ marginLeft: '0.5rem', marginRight: '0.5rem', width: 'calc(100% - 1rem)' }}
                  >
                    <ul className="py-2 text-sm text-gray-700" aria-labelledby={`brand-${brand.id}-button`}>
                      {brand.pizzas.map((pizza) => (
                        <li key={pizza.id}>
                          <a
                            href="#"
                            className={`block px-4 py-2 hover:bg-gray-100 ${selectedPizzaId === pizza.id ? 'bg-indigo-100 text-indigo-700 font-medium' : ''}`}
                            onClick={(e) => handlePizzaSelect(e, pizza.id)}
                          >
                            {pizza.name}
                          </a>
                        </li>
                      ))}
                    </ul>
                  </div>
                )}
              </li>
            ))}
          </ul>
        </div>
      )}
      
      {required && (
        <input type="hidden" name="pizza_id" value={selectedPizzaId || ''} required />
      )}
    </div>
  );
} 