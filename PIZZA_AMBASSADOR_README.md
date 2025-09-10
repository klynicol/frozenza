# Pizza Ambassador System

This document explains how to use the new Pizza Ambassador system that allows users with the `pizza-ambassador` role to submit new brands and pizzas to the application.

## Overview

The Pizza Ambassador system provides a way for trusted users to contribute to the pizza database by submitting:
- New pizza brands (with logos, descriptions, and brand stories)
- New pizzas under existing brands (with ingredients, allergens, and images)

## Setup

### 1. Create the Pizza Ambassador Role

First, run the seeder to create the `pizza-ambassador` role:

```bash
php artisan db:seed --class=PizzaAmbassadorRoleSeeder
```

### 2. Assign Role to Users

To assign the pizza-ambassador role to a user, you can either:

**Option A: Use the database directly**
```sql
INSERT INTO user_user_roles (user_id, user_role_id, created_at) 
SELECT 'user-uuid-here', ur.id, NOW() 
FROM user_roles ur 
WHERE ur.code = 'pizza-ambassador';
```

**Option B: Create an artisan command (recommended for production)**

### 3. Verify Role Assignment

Users with the `pizza-ambassador` role will see new navigation items:
- Ambassador Dashboard
- Submit Brand
- Submit Pizza

## Features

### Brand Submission

Users can submit new brands with:
- Brand name and description
- Website URL
- Founded year
- Brand story
- Unique selling points (dynamic list)
- Social media handles (dynamic list)
- Logo image upload

### Pizza Submission

Users can submit new pizzas with:
- Pizza name and description
- Brand selection (from existing brands)
- Style selection (optional)
- Ingredients list (dynamic)
- Allergen information
- Website URL
- Category selection (checkboxes)
- Tag selection (checkboxes)
- Pizza image upload

## Access Control

The system is protected by middleware that checks for the `pizza-ambassador` role:

```php
Route::middleware(['role:admin,pizza-ambassador'])->group(function () {
    // Pizza ambassador routes
});
```

Both `admin` and `pizza-ambassador` roles can access these features.

## File Structure

```
app/Http/Controllers/
├── BrandSubmissionController.php    # Handles brand submissions
└── PizzaSubmissionController.php    # Handles pizza submissions

resources/js/Pages/
├── BrandSubmission/
│   ├── Create.jsx                   # Brand submission form
│   └── Success.jsx                  # Success page
├── PizzaSubmission/
│   ├── Create.jsx                   # Pizza submission form
│   └── Success.jsx                  # Success page
└── PizzaAmbassador/
    └── Dashboard.jsx                # Ambassador dashboard
```

## Routes

- `GET /pizza-ambassador/dashboard` - Ambassador dashboard
- `GET /brand-submissions/create` - Brand submission form
- `POST /brand-submissions` - Submit brand
- `GET /brand-submissions/{brand}/success` - Brand submission success
- `GET /pizza-submissions/create` - Pizza submission form
- `POST /pizza-submissions` - Submit pizza
- `GET /pizza-submissions/{pizza}/success` - Pizza submission success

## Workflow

1. **User submits brand/pizza** through the form
2. **Data is validated** on the server
3. **Submission is stored** in the database
4. **Success page is shown** with next steps
5. **Admin review** (manual process - can be automated later)
6. **Approval/rejection** (can be implemented later)

## Future Enhancements

- Admin approval workflow
- Email notifications
- Submission history for users
- Bulk import functionality
- Image optimization and resizing
- Duplicate detection
- Submission analytics

## Security Considerations

- Role-based access control
- File upload validation
- Input sanitization
- CSRF protection
- Rate limiting (can be added)

## Testing

To test the system:

1. Create a user account
2. Assign the `pizza-ambassador` role
3. Log in and navigate to the Ambassador Dashboard
4. Try submitting a brand and pizza
5. Verify the data is stored correctly

## Troubleshooting

### Common Issues

1. **Role not working**: Ensure the role is created and assigned correctly
2. **File uploads failing**: Check file permissions and storage configuration
3. **Form validation errors**: Verify all required fields are filled
4. **Route not found**: Ensure routes are properly registered

### Debug Commands

```bash
# Check if role exists
php artisan tinker
>>> App\Models\UserRole::where('code', 'pizza-ambassador')->first();

# Check user roles
>>> App\Models\User::find(1)->roles;
```
