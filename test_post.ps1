$body = @{
    invoice_number = "INV-TEST-$(Get-Random -Minimum 1000 -Maximum 9999)"
    customer_name  = "Test API User"
    amount         = 999.99
    status         = "paid"
} | ConvertTo-Json

Write-Host "Testing POST request to create invoice..." -ForegroundColor Cyan
Write-Host "Request Body:" -ForegroundColor Yellow
Write-Host $body

try {
    $response = Invoke-RestMethod -Uri "http://localhost:8000/multi-response-demo" `
        -Method POST `
        -Body $body `
        -ContentType "application/json" `
        -Headers @{"Accept" = "application/json" }
    
    Write-Host "`nSuccess!" -ForegroundColor Green
    Write-Host "Response:" -ForegroundColor Yellow
    $response | ConvertTo-Json -Depth 3
}
catch {
    Write-Host "`nError!" -ForegroundColor Red
    Write-Host $_.Exception.Message
    if ($_.Exception.Response) {
        $stream = $_.Exception.Response.GetResponseStream()
        $reader = New-Object System.IO.StreamReader($stream)
        $responseBody = $reader.ReadToEnd()
        Write-Host "Response Body:" -ForegroundColor Yellow
        Write-Host $responseBody
    }
}
