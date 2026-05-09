# Quick Start: eSIM Packages Implementation

## Step 1: Run Database Migration

```bash
# Backend folder
cd c:\Users\win\Documents\Github\tilalr-backend-last

# Run migration
php artisan migrate

# Seed sample data (optional - for testing)
php artisan db:seed --class=EsimPackageSeeder
```

## Step 2: Update Routes (Already Done ✅)

The activate endpoint is now available at:
```
POST /api/international/packages/activate
```

## Step 3: Use Frontend Component

### Option A: Direct Component Usage
```jsx
import InternetPackagesForm_eSIM from '@/components/international/InternetPackagesForm_eSIM';

export default function Page() {
  return <InternetPackagesForm_eSIM lang="en" />;
}
```

### Option B: With App Router & Params
```jsx
import InternetPackagesForm_eSIM from '@/components/international/InternetPackagesForm_eSIM';

export default function Page({ params: { lang } }) {
  return (
    <div>
      <InternetPackagesForm_eSIM lang={lang} />
    </div>
  );
}
```

## Step 4: Create Your First eSIM Package (Admin Panel)

Via Filament Admin or API:

```bash
curl -X POST http://localhost:8000/api/international/packages \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{
    "type_en": "Limited Data",
    "title_en": "2 GB - 14 Days",
    "data_amount": "2 GB",
    "plan_type": "limited_data",
    "duration_en": "14 Days",
    "price": 12.50,
    "starting_price": "$5.00",
    "package_code": "GCC-2GB-14Days",
    "region_en": "GCC",
    "networks": ["Zain", "Etisalat"],
    "supported_countries": ["Saudi Arabia", "UAE"],
    "supported_countries_count": 2,
    "hotspot_tethering": true,
    "rechargeability": true,
    "description_en": "Perfect for 2-week travel",
    "active": true
  }'
```

## Step 5: Test API Endpoints

### Get All Packages
```bash
curl http://localhost:8000/api/international/packages
```

### Get Single Package
```bash
curl http://localhost:8000/api/international/packages/1
```

### Activate Package (User Action)
```bash
curl -X POST http://localhost:8000/api/international/packages/activate \
  -H "Content-Type: application/json" \
  -d '{
    "package_id": 1,
    "mobile_number": "+966501234567"
  }'
```

## Component Features Explained

### 1. Region Filtering
- Automatically extracted from `package_code` (e.g., "GCC" from "GCC-1GB-7Days")
- Buttons to select region
- Filters packages by selected region

### 2. Plan Type Tabs
- Automatically generates tabs from available `plan_type` values
- Tab 1: Limited Data packages
- Tab 2: Unlimited Data packages
- Only shows if multiple types exist

### 3. Duration Grouping
- Groups packages by `duration_en`
- Each duration gets its own section
- "7 Days", "15 Days", "30 Days", "60 Days", etc.

### 4. Package Cards
- Show data amount, price, and key features
- Click to select package
- Selection highlights card and shows details

### 5. Sidebar Details (When Package Selected)
- Package image
- Network list with badges
- Supported countries count
- Hotspot/Tethering status
- Rechargeability status
- Full description

### 6. Activation Form
- Mobile number input with validation
- Submit button
- Success/Error messages

## Database Field Reference

### Required Fields (for every package)
- `type_en`, `type_ar` - Package category
- `title_en`, `title_ar` - Package name
- `description_en`, `description_ar` - Description
- `data_amount` - Data quantity
- `package_code` - Unique identifier (format: "REGION-DATA-DURATION")

### Optional but Important
- `plan_type` - "limited_data" or "unlimited_data"
- `duration_en` - How long the package is valid
- `price` - Numeric price
- `networks` - JSON array of network names
- `supported_countries_count` - Number of countries
- `hotspot_tethering` - Boolean
- `rechargeability` - Boolean

### Multilingual Fields
```
_en = English
_ar = Arabic  
_zh = Chinese
```

Available for:
- type, title, description, duration, region, highlight

## API Response Format

### Success Response
```json
{
  "success": true,
  "data": { /* package data */ },
  "message": "Operation successful"
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error description",
  "errors": { /* validation errors */ }
}
```

## Multilingual Examples

### English Page
```
/en/esim-packages → Shows English UI & data
```

### Arabic Page
```
/ar/esim-packages → Shows Arabic UI & data (RTL layout)
```

### Chinese Page
```
/zh/esim-packages → Shows Chinese UI & data
```

## Troubleshooting Checklist

- [ ] Migration ran successfully: `php artisan migrate:status`
- [ ] Packages in database: `SELECT * FROM international_packages WHERE active=1`
- [ ] API responding: `curl http://localhost:8000/api/international/packages`
- [ ] Component renders without errors in browser console
- [ ] Images loading (check browser Network tab)
- [ ] Correct language selected
- [ ] Mobile number input working
- [ ] Activation endpoint responding

## Next Steps

1. **Upload eSIM Images**: Add package images to `storage/app/public/esim/`
2. **Create More Packages**: Add packages for other regions (EU, NA, ASIA, etc.)
3. **Integrate Payment**: Connect with payment gateway for activation
4. **Email Service**: Send QR code to user email
5. **Track Activations**: Store activation logs for analytics

## File Locations

| Component | Path |
|-----------|------|
| Frontend Component | `components/international/InternetPackagesForm_eSIM.jsx` |
| Backend Controller | `app/Http/Controllers/Api/InternationalPackageController.php` |
| Model | `app/Models/InternationalPackage.php` |
| Migration | `database/migrations/2026_05_09_000000_add_esim_fields_to_international_packages.php` |
| Seeder | `database/seeders/EsimPackageSeeder.php` |
| Routes | `routes/api.php` |
| Documentation | `ESIM_IMPLEMENTATION.md` |

## Support

For issues or questions:
1. Check `ESIM_IMPLEMENTATION.md` for detailed documentation
2. Review sample data in `EsimPackageSeeder.php`
3. Test API endpoints directly
4. Check browser console for frontend errors
5. Check Laravel logs: `storage/logs/laravel.log`
