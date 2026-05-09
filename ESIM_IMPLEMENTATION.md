# eSIM International Packages Implementation Guide

## Overview
This implementation provides a complete system for managing and displaying eSIM internet packages with multilingual support (English, Arabic, Chinese) and regional organization.

## Database Structure

### New Fields Added to `international_packages` Table

```sql
- data_amount (string) - e.g., "1GB", "3GB", "10GB"
- plan_type (string) - "limited_data" or "unlimited_data"
- networks (json) - Array of network names (e.g., ["Zain", "Etisalat", "Mobily"])
- supported_countries (json) - Array of country names
- supported_countries_count (integer) - Number of supported countries
- hotspot_tethering (boolean) - Whether hotspot sharing is allowed
- rechargeability (boolean) - Whether the package can be recharged
- starting_price (string) - Display price (e.g., "$5.00")
- package_code (string, unique) - Regional identifier (e.g., "GCC-3GB-30Days")
- region_en, region_ar, region_zh (string) - Region name in each language
```

### Migration File
`database/migrations/2026_05_09_000000_add_esim_fields_to_international_packages.php`

Run migration:
```bash
php artisan migrate
```

## API Endpoints

### Public Endpoints

#### 1. List All eSIM Packages
```
GET /api/international/packages
```

Response:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "type_en": "Limited Data",
      "title_en": "1 GB - 7 Days",
      "data_amount": "1 GB",
      "plan_type": "limited_data",
      "duration_en": "7 Days",
      "price": 6.00,
      "starting_price": "$5.00",
      "package_code": "GCC-1GB-7Days",
      "networks": ["Zain", "Etisalat", "Mobily", "du"],
      "supported_countries_count": 6,
      "hotspot_tethering": true,
      "rechargeability": true,
      "image": "storage/esim/gcc-package.webp"
    }
  ]
}
```

#### 2. Get Single Package
```
GET /api/international/packages/{id}
```

#### 3. Activate eSIM Package
```
POST /api/international/packages/activate
Content-Type: application/json

{
  "package_id": 1,
  "mobile_number": "+966501234567"
}
```

Response:
```json
{
  "success": true,
  "data": {
    "package": { ... },
    "mobile_number": "+966501234567",
    "activation_status": "pending",
    "activated_at": "2026-05-09T12:34:56Z"
  },
  "message": "Package activated successfully. You will receive QR code via email."
}
```

### Admin Endpoints (Requires Authentication)

#### Create Package
```
POST /api/international/packages
```

#### Update Package
```
PUT /api/international/packages/{id}
```

#### Delete Package
```
DELETE /api/international/packages/{id}
```

## Frontend Component

### InternetPackagesForm_eSIM Component

**Location:** `components/international/InternetPackagesForm_eSIM.jsx`

**Features:**
- Automatic region detection and selection
- Plan type filtering (Limited Data vs Unlimited Data)
- Packages grouped by duration
- Network and country information display
- Hotspot/Tethering and Rechargeability status
- Mobile activation with validation
- Real-time API data fetching
- Multilingual support (English, Arabic, Chinese)

**Usage:**
```jsx
import InternetPackagesForm_eSIM from '@/components/international/InternetPackagesForm_eSIM';

export default function Page({ params: { lang } }) {
  return (
    <InternetPackagesForm_eSIM lang={lang} />
  );
}
```

**Props:**
- `lang` - Language code ("en", "ar", "zh")
- `packageId` - (Optional) Pre-select a specific package region

## Data Structure Example

### Package Creation Example

```php
InternationalPackage::create([
    'type_en' => 'Limited Data',
    'type_ar' => 'بيانات محدودة',
    'type_zh' => '有限数据',
    'region_en' => 'GCC',
    'region_ar' => 'دول مجلس التعاون',
    'region_zh' => 'GCC国家',
    'title_en' => '1 GB - 7 Days',
    'title_ar' => '1 جيجابايت - 7 أيام',
    'title_zh' => '1GB - 7天',
    'description_en' => 'eSIM for GCC countries...',
    'data_amount' => '1 GB',
    'plan_type' => 'limited_data',
    'duration_en' => '7 Days',
    'price' => 6.00,
    'starting_price' => '$5.00',
    'package_code' => 'GCC-1GB-7Days',
    'networks' => ['Zain', 'Etisalat', 'Mobily', 'du'],
    'supported_countries' => ['Saudi Arabia', 'UAE', 'Kuwait', 'Qatar', 'Bahrain', 'Oman'],
    'supported_countries_count' => 6,
    'hotspot_tethering' => true,
    'rechargeability' => true,
    'features_en' => ['Feature 1', 'Feature 2'],
    'active' => true,
]);
```

## Seeding Sample Data

### Run the eSIM Seeder
```bash
php artisan db:seed --class=EsimPackageSeeder
```

This will add sample GCC eSIM packages to the database with:
- 4 different data packages (1GB, 1.5GB, 3GB, 10GB)
- Multiple duration options (7, 15, 30, 60 days)
- Both Limited and Unlimited data types
- All required fields and multilingual content

## Component Organization

### Display Logic

1. **Region Selection**: Auto-detected from `package_code` prefix
   - GCC, EU, ASIA, NA, etc.

2. **Plan Type Tabs**: Automatic tabs based on available `plan_type` values
   - Limited Data
   - Unlimited Data

3. **Duration Grouping**: Packages grouped by `duration_en`
   - 7 Days
   - 15 Days
   - 30 Days
   - 60 Days
   - etc.

4. **Package Cards**: Display key info
   - Data amount
   - Price
   - Supported countries count
   - Hotspot/Tethering availability

5. **Sidebar Details**: Show comprehensive info when package selected
   - Image
   - Networks
   - All features
   - Rechargeability status

## Multilingual Support

All fields are stored in three languages:

```
_en (English)
_ar (Arabic)
_zh (Chinese)
```

The component automatically selects the appropriate language based on the `lang` prop.

## Image Handling

Images are resolved with cache busting:
```
asset('storage/esim/package.webp?v=' . strtotime($updated_at))
```

Supports:
- Relative paths: `esim/package.webp`
- Absolute paths: `/storage/esim/package.webp`
- Full URLs: `https://example.com/image.webp`

## Filament Admin Interface

The Filament resource automatically supports all new fields in the admin panel:
- File manager for image uploads
- Array fields for networks and supported countries
- Boolean toggles for hotspot_tethering and rechargeability
- Text inputs for all multilingual fields

## Testing Endpoints

### List Packages
```bash
curl http://localhost:8000/api/international/packages
```

### Get Single Package
```bash
curl http://localhost:8000/api/international/packages/1
```

### Activate Package
```bash
curl -X POST http://localhost:8000/api/international/packages/activate \
  -H "Content-Type: application/json" \
  -d '{"package_id":1,"mobile_number":"+966501234567"}'
```

## Error Handling

The API returns standardized error responses:

```json
{
  "success": false,
  "message": "Error description",
  "errors": { /* Validation errors if applicable */ }
}
```

## Performance Considerations

1. **Caching**: Implement caching for the package list in production
   ```php
   $packages = Cache::remember('international_packages', 3600, function () {
       return InternationalPackage::where('active', true)->get();
   });
   ```

2. **Pagination**: For large datasets, add pagination to the index endpoint

3. **Lazy Loading**: Component fetches data on mount

## Future Enhancements

- [ ] Payment integration for package purchase
- [ ] QR code generation and email delivery
- [ ] Order tracking system
- [ ] User account management
- [ ] Review and ratings system
- [ ] Real-time network availability checking
- [ ] Country-specific pricing
- [ ] Promo code/discount system
- [ ] Analytics and reporting

## Troubleshooting

### No packages displaying
- Check if packages are active: `active = true`
- Verify API endpoint is accessible
- Check browser console for CORS errors

### Images not loading
- Verify image path in database
- Check if storage symlink exists: `php artisan storage:link`
- Ensure image files exist in storage

### Multilingual content not showing
- Verify lang prop is passed correctly
- Check if translations exist for selected language
- Default falls back to English if translations missing

## File Locations Summary

| File | Purpose |
|------|---------|
| `database/migrations/2026_05_09_000000_add_esim_fields_to_international_packages.php` | Database schema |
| `app/Models/InternationalPackage.php` | Model with new field casts |
| `app/Http/Controllers/Api/InternationalPackageController.php` | API endpoints including activation |
| `database/seeders/EsimPackageSeeder.php` | Sample data |
| `components/international/InternetPackagesForm_eSIM.jsx` | Frontend component |
| `routes/api.php` | API route definitions |
