# Production Deployment & Troubleshooting Guide

## Backend (Laravel) - Production Setup

### 1. Deploy .env File
Copy `.env.production` to `.env` on your production server:
```bash
cp .env.production .env
```

### 2. Update Database Credentials
Edit `.env` and verify:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u710227726_test
DB_USERNAME=u710227726_test
DB_PASSWORD=AA123qweS@AA123qweS@
```

### 3. Run Migrations
```bash
php artisan migrate --force
```

This ensures all database tables including the new `total_amount` and `transaction_id` columns are created.

### 4. Clear Cache
```bash
php artisan config:cache
php artisan cache:clear
php artisan view:clear
```

### 5. Set File Permissions
```bash
chmod -R 755 storage/logs
chmod -R 755 bootstrap/cache
chmod -R 755 storage
```

---

## Frontend (Next.js) - Production Setup

### 1. Set Environment Variables
On your hosting platform (Vercel, etc.), set:
```
NEXT_PUBLIC_API_URL=https://test.tilalr.com/api
NEXT_PUBLIC_MOYASAR_PUBLISHABLE_KEY=pk_test_RkhX8tYa6szipY7w5ZQF33pz5YZAbxa42qqGbmJh
```

**Do NOT commit `.env` files** - they should only be set in your hosting platform's dashboard.

### 2. Build and Deploy
```bash
npm run build
npm start
```

---

## Troubleshooting 500 Error

If you see `500 Internal Server Error` when booking:

### Check Backend Logs
```bash
tail -f storage/logs/laravel.log
```

Look for errors like:
- `Column not found` → Run migrations: `php artisan migrate --force`
- `SQLSTATE` → Check database connection in `.env`
- `Call to undefined method` → Clear cache: `php artisan cache:clear`

### Common Issues

**1. Database Connection Failed**
```
Solution: Verify DB_HOST, DB_USERNAME, DB_PASSWORD in .env
```

**2. Missing Columns**
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'total_amount'
Solution: Run migrations
php artisan migrate --force
```

**3. Laravel Key Missing**
```
Solution: Generate key
php artisan key:generate
```

**4. File Permissions**
```
Solution: Fix permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap
```

**5. CORS Errors**
Ensure `.env` has correct `FRONTEND_URL`:
```
FRONTEND_URL=https://test.tilalr.com
```

---

## API Endpoints Check

Test these endpoints in production:

### Health Check
```bash
curl https://test.tilalr.com/api/health
```

### Create Booking
```bash
curl -X POST https://test.tilalr.com/api/bookings/guest \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "Test",
    "last_name": "User",
    "email": "test@example.com",
    "mobile": "1234567890",
    "travel_date": "2026-07-20",
    "room_type": "DoubleRoom",
    "package_id": "2",
    "booking_type": "tourism_offer",
    "payment_method": "credit_card",
    "total_amount": 1800,
    "guests": 1
  }'
```

### Expected Success Response
```json
{
  "success": true,
  "message": "Booking created successfully",
  "data": {
    "id": 123,
    "booking_number": "BK1234567",
    "total_amount": "1800.00",
    "status": "pending",
    "payment_status": "pending"
  }
}
```

---

## Next Steps

1. **Deploy backend changes**
   - Copy `.env.production` as `.env`
   - Run migrations
   - Clear caches

2. **Deploy frontend changes**
   - Set environment variables in hosting dashboard
   - Rebuild and redeploy

3. **Test the flow**
   - Try booking a tourism offer
   - Verify booking created in database
   - Check payment form appears
   - Test payment process

---

## Quick Checklist

- [ ] Backend: `.env` file updated from `.env.production`
- [ ] Backend: `php artisan migrate --force` executed
- [ ] Backend: `php artisan cache:clear` executed
- [ ] Backend: File permissions set correctly
- [ ] Frontend: `NEXT_PUBLIC_API_URL` environment variable set
- [ ] Frontend: Application rebuilt and deployed
- [ ] Test: Health check endpoint works
- [ ] Test: Booking creation works
- [ ] Test: Payment flow completes successfully
