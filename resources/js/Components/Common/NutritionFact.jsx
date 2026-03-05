import React from 'react';
import './NutritionFact.css';

// Parse value from API (number or string like "18" or "18g") to number for calculations
function parseNutrientValue(value) {
   if (value == null || value === '') return null;
   if (typeof value === 'number' && !Number.isNaN(value)) return value;
   const num = parseFloat(String(value).replace(/[^0-9.-]/g, ''));
   return Number.isNaN(num) ? null : num;
}

// Format number for display (trim trailing zeros) and append unit
const NUTRIENT_UNITS = {
   total_fat: 'g', saturated_fat: 'g', trans_fat: 'g',
   cholesterol: 'mg', sodium: 'mg', calcium: 'mg', iron: 'mg', potassium: 'mg',
   total_carbohydrate: 'g', dietary_fiber: 'g', total_sugars: 'g', added_sugars: 'g', protein: 'g',
   vitamin_d: 'mcg', vitamin_a: 'mcg', vitamin_c: 'mg',
   monounsaturated_fat: 'g', polyunsaturated_fat: 'g',
};
function formatDisplayValue(value, nutrient) {
   const num = parseNutrientValue(value);
   if (num == null) return '';
   const unitKey = typeof nutrient === 'string' ? nutrient.toLowerCase() : nutrient;
   const unit = NUTRIENT_UNITS[unitKey] || '';
   const formatted = Number.isInteger(num) ? String(num) : String(Number(num.toFixed(2)));
   return unit ? `${formatted}${unit}` : formatted;
}

const DAILY_VALUES = {
   TOTAL_FAT: 78,
   SATURATED_FAT: 20,
   TRANS_FAT: 0,
   CHOLESTEROL: 300,
   SODIUM: 2300,
   TOTAL_CARBOHYDRATE: 275,
   DIETARY_FIBER: 28,
   ADDED_SUGARS: 50,
   PROTEIN: 50,
   VITAMIN_D: 20,
   CALCIUM: 1300,
   IRON: 18,
   POTASSIUM: 4700,
   VITAMIN_A: 900,
   VITAMIN_C: 90,
};

export default function NutritionFact({ nutritionFact }) {
   if (!nutritionFact) {
      return (
         <div className="nutrition-facts">
            <p>No nutrition facts available</p>
         </div>
      );
   }

   const calculateDailyValue = (value, nutrient) => {
      const valueNumber = parseNutrientValue(value);
      if (valueNumber == null || valueNumber === 0) return '0';
      const dv = DAILY_VALUES[nutrient];
      if (dv == null || dv === 0) return '—';
      return String(Math.round((valueNumber / dv) * 100));
   };

   const renderRow = (value, label, nutrientKey, strong = false, indentSub = false, blockEnd = false) => {
      const display = formatDisplayValue(value, nutrientKey);
      if (!display) return null;
      const pct = nutrientKey && DAILY_VALUES[nutrientKey] !== undefined
         ? calculateDailyValue(value, nutrientKey)
         : null;
      const classes = [
         indentSub && 'indent-sub',
         blockEnd && 'nutrient-block-end',
      ].filter(Boolean).join(' ');
      return (
         <p className={classes || undefined}>
            {strong ? <strong>{label} </strong> : <>{label} </>}
            {display}
            {pct != null && pct !== '—' && <span className="float-right">{pct}%</span>}
            {pct === '—' && <span className="float-right">—</span>}
         </p>
      );
   };

   const servingLabel = [
      nutritionFact.serving_fraction && `${nutritionFact.serving_fraction} pizza`,
      nutritionFact.serving_weight != null && nutritionFact.serving_weight > 0 && `(${nutritionFact.serving_weight}g)`,
   ].filter(Boolean).join(' ');

   return (
      <div className="nutrition-facts w-[300px] border p-4 max-w-xs mx-auto">
         <h2 className="text-xl font-bold border-b pb-1 mb-2">Nutrition Facts</h2>
         {nutritionFact.serving_per_container != null && (
            <p className="text-sm">{nutritionFact.serving_per_container} {nutritionFact.serving_per_container === 1 ? 'serving' : 'servings'} per container</p>
         )}
         {servingLabel && (
            <p className="text-sm font-semibold">
               <strong>Serving size</strong> {servingLabel}
            </p>
         )}
         <hr className="my-2" />
         {nutritionFact.calories != null && (
            <>
               <div>Amount Per Serving</div>
               <p className="text-2xl font-bold"><strong>Calories</strong> <span className="float-right">{nutritionFact.calories}</span></p>
            </>
         )}
         <div className="border-t-4 border-gray-800 text-sm">
            <p className="font-semibold text-right"><strong>% Daily Value*</strong></p>
            {renderRow(nutritionFact.total_fat, 'Total Fat', 'TOTAL_FAT', true)}
            {renderRow(nutritionFact.saturated_fat, 'Saturated Fat', 'SATURATED_FAT', false, true)}
            {renderRow(nutritionFact.trans_fat, 'Trans Fat', 'TRANS_FAT', false, true, true)}
            {renderRow(nutritionFact.cholesterol, 'Cholesterol', 'CHOLESTEROL', true)}
            {renderRow(nutritionFact.sodium, 'Sodium', 'SODIUM', true)}
            {renderRow(nutritionFact.total_carbohydrate, 'Total Carbohydrate', 'TOTAL_CARBOHYDRATE', true)}
            {renderRow(nutritionFact.dietary_fiber, 'Dietary Fiber', 'DIETARY_FIBER', false, true)}
            {renderRow(nutritionFact.total_sugars, 'Sugars', 'TOTAL_SUGARS', false, true)}
            {renderRow(nutritionFact.added_sugars, 'Added Sugars', 'ADDED_SUGARS', false, true, true)}
            {renderRow(nutritionFact.protein, 'Protein', 'PROTEIN', true)}
         </div>
         <hr className="my-2" />
         <div className="text-sm vitamins-minerals">
            {renderRow(nutritionFact.vitamin_d, 'Vitamin D', 'VITAMIN_D')}
            {renderRow(nutritionFact.potassium, 'Potassium', 'POTASSIUM')}
            {renderRow(nutritionFact.iron, 'Iron', 'IRON')}
            {renderRow(nutritionFact.calcium, 'Calcium', 'CALCIUM')}
            {renderRow(nutritionFact.vitamin_a, 'Vitamin A', 'VITAMIN_A')}
            {renderRow(nutritionFact.vitamin_c, 'Vitamin C', 'VITAMIN_C')}
         </div>
         <p className="border-t border-gray-800 footnote text-xs mt-2">* The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2,000 calories a day is used for general nutrition advice.</p>
      </div>
   );
}