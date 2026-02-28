import React from 'react';
import './NutritionFact.css'; // Import the CSS file for styling

export default function NutritionFact({ nutritionFact }) {

   if (!nutritionFact) {
      return (
         <div>
            <p>No nutrition facts available</p>
         </div>
      )
   }

   // Helper function to calculate the % Daily Value
   const calculateDailyValue = (value, nutrient) => {
      // strip the mg, g, mcg, etc. from the value
      const valueNumber = parseFloat(value.replace(/[mgc]/g, ''));
      if (isNaN(valueNumber) || valueNumber == 0) {
         return '0';
      }
      const dv = {
         'TOTAL_FAT': 78,
         'SATURATED_FAT': 20,
         'TRANS_FAT': 0,
         'CHOLESTEROL': 300,
         'SODIUM': 2300,
         'TOTAL_CARBOHYDRATE': 275,
         'DIETARY_FIBER': 28,
         'ADDED_SUGARS': 50,
         'PROTEIN': 50,
         'VITAMIN_D': 20,
         'CALCIUM': 1300,
         'IRON': 18,
         'POTASSIUM': 4700
      };
      return Math.round((valueNumber / dv[nutrient]) * 100);
   };

   return (
      <div className="w-[300px] border p-4 max-w-xs mx-auto">
         <h2 className="text-xl font-bold border-b pb-1 mb-2">Nutrition Facts</h2>
         {nutritionFact.serving_per_container != null && (
            <p className="text-sm">{nutritionFact.serving_per_container} {nutritionFact.serving_per_container === 1 ? 'serving' : 'servings'} per container</p>
         )}
         {(nutritionFact.serving_fraction || nutritionFact.serving_weight != null) && (
            <p className="text-sm font-semibold">
               <strong>Serving size</strong>{' '}
               {[nutritionFact.serving_fraction && `${nutritionFact.serving_fraction} pizza`, nutritionFact.serving_weight != null && `(${nutritionFact.serving_weight}g)`].filter(Boolean).join(' ')}
            </p>
         )}
         <hr className="my-2" />
         {nutritionFact.calories && (
            <>
               <div>Amount Per Serving</div>
               <p className="text-2xl font-bold"><strong>Calories</strong> <span className="float-right">{nutritionFact.calories}</span></p>
            </>
         )}
         <div className="border-t-4 border-gray-800 text-sm">
            <p className="font-semibold text-right"><strong>% Daily Value*</strong></p>
            {nutritionFact.total_fat && (
               <p><strong>Total Fat</strong> {nutritionFact.total_fat} <span className="float-right">{calculateDailyValue(nutritionFact.total_fat, 'TOTAL_FAT')}%</span></p>
            )}
            {nutritionFact.saturated_fat && (
               <p className="indent ml-4">Saturated Fat {nutritionFact.saturated_fat} <span className="float-right">{calculateDailyValue(nutritionFact.saturated_fat, 'SATURATED_FAT')}%</span></p>
            )}
            {nutritionFact.trans_fat && (
               <p className="indent ml-4">Trans Fat {nutritionFact.trans_fat} <span className="float-right">{calculateDailyValue(nutritionFact.trans_fat, 'TRANS_FAT')}%</span></p>
            )}
            {nutritionFact.cholesterol && (
               <p><strong>Cholesterol</strong> {nutritionFact.cholesterol} <span className="float-right">{calculateDailyValue(nutritionFact.cholesterol, 'CHOLESTEROL')}%</span></p>
            )}
            {nutritionFact.sodium && (
               <p><strong>Sodium</strong> {nutritionFact.sodium} <span className="float-right">{calculateDailyValue(nutritionFact.sodium, 'SODIUM')}%</span></p>
            )}
            {nutritionFact.total_carbohydrate && (
               <p><strong>Total Carbohydrate</strong> {nutritionFact.total_carbohydrate} <span className="float-right">{calculateDailyValue(nutritionFact.total_carbohydrate, 'TOTAL_CARBOHYDRATE')}%</span></p>
            )}
            {nutritionFact.dietary_fiber && (
               <p className="indent ml-4">Dietary Fiber {nutritionFact.dietary_fiber} <span className="float-right">{calculateDailyValue(nutritionFact.dietary_fiber, 'DIETARY_FIBER')}%</span></p>
            )}
            {nutritionFact.total_sugars && (
               <p className="indent ml-4">Sugars {nutritionFact.total_sugars}</p>
            )}
            {nutritionFact.added_sugars && (
               <p className="indent ml-4">Added Sugars {nutritionFact.added_sugars} <span className="float-right">{calculateDailyValue(nutritionFact.added_sugars, 'ADDED_SUGARS')}%</span></p>
            )}
            {nutritionFact.protein && (
               <p><strong>Protein</strong> {nutritionFact.protein} <span className="float-right">{calculateDailyValue(nutritionFact.protein, 'PROTEIN')}%</span></p>
            )}
         </div>
         <hr className="my-2" />
         {nutritionFact.vitamin_d && (
            <p className="text-sm">Vitamin D {nutritionFact.vitamin_d} <span className="float-right">{calculateDailyValue(nutritionFact.vitamin_d, 'VITAMIN_D')}%</span></p>
         )}
         {nutritionFact.potassium && (
            <p className="text-sm">Potassium {nutritionFact.potassium} <span className="float-right">{calculateDailyValue(nutritionFact.potassium, 'POTASSIUM')}%</span></p>
         )}
         {nutritionFact.iron && (
            <p className="text-sm">Iron {nutritionFact.iron} <span className="float-right">{calculateDailyValue(nutritionFact.iron, 'IRON')}%</span></p>
         )}
         {nutritionFact.calcium && (
            <p className="text-sm">Calcium {nutritionFact.calcium} <span className="float-right">{calculateDailyValue(nutritionFact.calcium, 'CALCIUM')}%</span></p>
         )}
         <p className="border-t border-gray-800 footnote text-xs mt-2">* The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2,000 calories a day is used for general nutrition advice.</p>
      </div>
   );
}