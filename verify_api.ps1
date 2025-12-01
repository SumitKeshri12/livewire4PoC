$baseUrl = "http://localhost:8000/multi-response-demo"

Write-Host "--- Testing JSON GET ---" -ForegroundColor Cyan
try {
    $json = Invoke-RestMethod -Uri $baseUrl -Headers @{"Accept"="application/json"}
    Write-Host "Success! Count: $($json.Count)" -ForegroundColor Green
    if ($json.Count -gt 0) {
        Write-Host "First Invoice: $($json[0].invoice_number)" -ForegroundColor Gray
    }
} catch {
    Write-Host "Failed: $_" -ForegroundColor Red
}

Write-Host "`n--- Testing PDF GET ---" -ForegroundColor Cyan
try {
    $pdfPath = "test_invoice.pdf"
    Invoke-WebRequest -Uri $baseUrl -Headers @{"Accept"="application/pdf"} -OutFile $pdfPath
    if (Test-Path $pdfPath) {
        $size = (Get-Item $pdfPath).Length
        Write-Host "Success! PDF created ($size bytes)" -ForegroundColor Green
    } else {
        Write-Host "Failed: PDF file not created" -ForegroundColor Red
    }
} catch {
    Write-Host "Failed: $_" -ForegroundColor Red
}

Write-Host "`n--- Testing HTML GET ---" -ForegroundColor Cyan
try {
    $html = Invoke-WebRequest -Uri $baseUrl
    if ($html.Content -match "Multi-Format Response Demo") {
        Write-Host "Success! HTML page loaded" -ForegroundColor Green
    } else {
        Write-Host "Failed: HTML content mismatch" -ForegroundColor Red
    }
} catch {
    Write-Host "Failed: $_" -ForegroundColor Red
}

Write-Host "`n--- Testing JSON POST ---" -ForegroundColor Cyan
try {
    $body = @{
        invoice_number = "INV-TEST-$(Get-Random)"
        customer_name = "Test API User"
        amount = 999.99
        status = "paid"
    } | ConvertTo-Json

    $response = Invoke-RestMethod -Uri $baseUrl -Method POST -Body $body -ContentType "application/json" -Headers @{"Accept"="application/json"}
    
    if ($response.success) {
        Write-Host "Success! Invoice created via API" -ForegroundColor Green
        Write-Host "Response: $($response.data | ConvertTo-Json -Depth 1)" -ForegroundColor Gray
    } else {
        Write-Host "Failed: API returned success=false" -ForegroundColor Red
    }
} catch {
    Write-Host "Failed: $_" -ForegroundColor Red
    if ($_.Exception.Response) {
        $stream = $_.Exception.Response.GetResponseStream()
        $reader = New-Object System.IO.StreamReader($stream)
        Write-Host "Error Body: $($reader.ReadToEnd())" -ForegroundColor Red
    }
}
