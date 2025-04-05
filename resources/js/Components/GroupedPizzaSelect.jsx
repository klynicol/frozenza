import React, { useState, useRef, useEffect } from 'react';
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/react/20/solid';
import { Combobox } from '@headlessui/react';

export default function GroupedPizzaSelect({
   pizzas,
   selectedPizzaId,
   onChange,
   placeholder = "Select a pizza",
   className = "",
   required = false,
   hasError = false
}) {
   // Group pizzas by brand
   const groupedPizzas = pizzas.reduce((groups, pizza) => {
      const brandName = pizza.brand?.name || 'Other';
      if (!groups[brandName]) {
         groups[brandName] = [];
      }
      groups[brandName].push(pizza);
      return groups;
   }, {});

   // Sort brand names alphabetically
   const sortedBrandNames = Object.keys(groupedPizzas).sort();

   const [query, setQuery] = useState('');
   const [open, setOpen] = useState(false);

   // Find the selected pizza object
   const selectedPizza = pizzas.find(pizza => pizza.id === selectedPizzaId);

   // Filter pizzas based on search query
   const filteredPizzas = query === ''
      ? groupedPizzas
      : sortedBrandNames.reduce((filtered, brandName) => {
         const matchingPizzas = groupedPizzas[brandName].filter(pizza =>
            pizza.name.toLowerCase().includes(query.toLowerCase()) ||
            brandName.toLowerCase().includes(query.toLowerCase())
         );

         if (matchingPizzas.length > 0) {
            filtered[brandName] = matchingPizzas;
         }

         return filtered;
      }, {});

   // Click outside to close
   const comboboxRef = useRef(null);

   useEffect(() => {
      const handleClickOutside = (event) => {
         if (comboboxRef.current && !comboboxRef.current.contains(event.target)) {
            setOpen(false);
         }
      };

      document.addEventListener('mousedown', handleClickOutside);
      return () => {
         document.removeEventListener('mousedown', handleClickOutside);
      };
   }, []);

   return (
      <div className={`relative ${className}`} ref={comboboxRef}>
         <Combobox value={selectedPizzaId} onChange={onChange}>
            <div className="relative">
               <div className={`
            bg-white relative w-full cursor-default rounded-md border 
            ${hasError ? 'border-red-500' : 'border-gray-300'} 
            py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 
            focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm
          `}>
                  <Combobox.Button className="w-full flex items-center" onClick={() => setOpen(!open)}>
                     <span className="block truncate">
                        {selectedPizza
                           ? `${selectedPizza.name} (${selectedPizza.brand?.name || 'Unknown Brand'})`
                           : placeholder}
                     </span>
                     <span className="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                        <ChevronUpDownIcon
                           className="h-5 w-5 text-gray-400"
                           aria-hidden="true"
                        />
                     </span>
                  </Combobox.Button>

                  <Combobox.Input
                     className="w-full border-none p-0 focus:ring-0 text-sm"
                     onChange={(event) => setQuery(event.target.value)}
                     displayValue={() =>
                        selectedPizza
                           ? `${selectedPizza.name} (${selectedPizza.brand?.name || 'Unknown Brand'})`
                           : ''
                     }
                     placeholder={placeholder}
                     onClick={() => setOpen(true)}
                     required={required}
                  />
               </div>

               <Combobox.Options
                  className={`absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm ${!open && 'hidden'}`}
                  static
               >
                  {query === '' && selectedPizzaId && (
                     <Combobox.Option
                        value=""
                        className={({ active }) =>
                           `relative cursor-default select-none py-2 pl-3 pr-9 ${active ? 'bg-indigo-600 text-white' : 'text-gray-900'
                           }`
                        }
                     >
                        <span className="block truncate font-medium">Clear selection</span>
                     </Combobox.Option>
                  )}

                  {Object.keys(filteredPizzas).length === 0 && query !== '' ? (
                     <div className="relative cursor-default select-none py-2 px-4 text-gray-700">
                        Nothing found.
                     </div>
                  ) : (
                     Object.keys(filteredPizzas).sort().map(brandName => (
                        <div key={brandName}>
                           <div className="sticky top-0 z-20 bg-gray-100 px-4 py-1 text-sm font-semibold text-gray-900">
                              {brandName}
                           </div>
                           <ul>
                              {filteredPizzas[brandName].map(pizza => (
                                 <Combobox.Option
                                    key={pizza.id}
                                    value={pizza.id}
                                    className={({ active }) =>
                                       `relative cursor-default select-none py-2 pl-10 pr-4 ${active ? 'bg-indigo-600 text-white' : 'text-gray-900'
                                       }`
                                    }
                                 >
                                    {({ selected, active }) => (
                                       <>
                                          <span className={`block truncate ${selected ? 'font-medium' : 'font-normal'}`}>
                                             {pizza.name}
                                          </span>

                                          {selected ? (
                                             <span
                                                className={`absolute inset-y-0 left-0 flex items-center pl-3 ${active ? 'text-white' : 'text-indigo-600'
                                                   }`}
                                             >
                                                <CheckIcon className="h-5 w-5" aria-hidden="true" />
                                             </span>
                                          ) : null}
                                       </>
                                    )}
                                 </Combobox.Option>
                              ))}
                           </ul>
                        </div>
                     ))
                  )}
               </Combobox.Options>
            </div>
         </Combobox>
      </div>
   );
} 