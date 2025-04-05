import React from 'react';
import { useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import Checkbox from '@/Components/Checkbox';
import MultiLevelPizzaDropdown from '@/Components/MultiLevelPizzaDropdown';

export default function Form({ affiliateLink = null, pizzas, submitLabel = 'Save', onCancel }) {
  const { data, setData, post, put, processing, errors } = useForm({
    pizza_id: affiliateLink?.pizza_id || '',
    vendor_name: affiliateLink?.vendor_name || '',
    url: affiliateLink?.url || '',
    commission_rate: affiliateLink?.commission_rate || '',
    description: affiliateLink?.description || '',
    is_active: affiliateLink?.is_active ?? true,
    display_order: affiliateLink?.display_order || 0,
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    
    if (affiliateLink) {
      put(route('admin.affiliate-links.update', affiliateLink.id));
    } else {
      post(route('admin.affiliate-links.store'));
    }
  };

  const handlePizzaChange = (pizzaId) => {
    setData('pizza_id', pizzaId || '');
  };

  return (
    <form onSubmit={handleSubmit} className="space-y-6">
      <div>
        <InputLabel htmlFor="pizza_id" value="Pizza" />
        <MultiLevelPizzaDropdown
          pizzas={pizzas}
          selectedPizzaId={data.pizza_id}
          onChange={handlePizzaChange}
          placeholder="Select a pizza"
          className="mt-1"
          required={true}
          hasError={!!errors.pizza_id}
        />
        <InputError message={errors.pizza_id} className="mt-2" />
      </div>

      <div>
        <InputLabel htmlFor="vendor_name" value="Vendor Name" />
        <TextInput
          id="vendor_name"
          type="text"
          name="vendor_name"
          value={data.vendor_name}
          className="mt-1 block w-full"
          onChange={(e) => setData('vendor_name', e.target.value)}
          required
        />
        <InputError message={errors.vendor_name} className="mt-2" />
      </div>

      <div>
        <InputLabel htmlFor="url" value="URL" />
        <TextInput
          id="url"
          type="url"
          name="url"
          value={data.url}
          className="mt-1 block w-full"
          onChange={(e) => setData('url', e.target.value)}
          required
        />
        <InputError message={errors.url} className="mt-2" />
      </div>

      <div>
        <InputLabel htmlFor="commission_rate" value="Commission Rate (%)" />
        <TextInput
          id="commission_rate"
          type="number"
          step="0.01"
          min="0"
          max="100"
          name="commission_rate"
          value={data.commission_rate}
          className="mt-1 block w-full"
          onChange={(e) => setData('commission_rate', e.target.value)}
        />
        <InputError message={errors.commission_rate} className="mt-2" />
      </div>

      <div>
        <InputLabel htmlFor="description" value="Description" />
        <TextInput
          id="description"
          type="text"
          name="description"
          value={data.description}
          className="mt-1 block w-full"
          onChange={(e) => setData('description', e.target.value)}
        />
        <InputError message={errors.description} className="mt-2" />
      </div>

      <div>
        <InputLabel htmlFor="display_order" value="Display Order" />
        <TextInput
          id="display_order"
          type="number"
          min="0"
          name="display_order"
          value={data.display_order}
          className="mt-1 block w-full"
          onChange={(e) => setData('display_order', e.target.value)}
        />
        <InputError message={errors.display_order} className="mt-2" />
      </div>

      <div className="flex items-center">
        <Checkbox
          id="is_active"
          name="is_active"
          checked={data.is_active}
          onChange={(e) => setData('is_active', e.target.checked)}
        />
        <InputLabel htmlFor="is_active" value="Active" className="ml-2" />
      </div>

      <div className="flex items-center justify-end space-x-3">
        <button
          type="button"
          onClick={onCancel}
          className="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
        >
          Cancel
        </button>
        <button
          type="submit"
          disabled={processing}
          className="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
        >
          {processing ? 'Saving...' : submitLabel}
        </button>
      </div>
    </form>
  );
} 