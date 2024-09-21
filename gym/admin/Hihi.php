<!DOCTYPE html>
<html>
<head>
    <title>Đơn hàng PDF</title>
</head>
<body>
    <h1>Đơn hàng của bạn</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Mã hàng</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PROD001</td>
                <td>T-shirt</td>
                <td>2</td>
                <td>$10.00</td>
                <td>$20.00</td>
            </tr>
            <tr>
                <td>PROD002</td>
                <td>Jeans</td>
                <td>1</td>
                <td>$30.00</td>
                <td>$30.00</td>
            </tr>
        </tbody>
    </table>

    <button id="generate-pdf">Xuất PDF</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('generate-pdf').addEventListener('click', generatePDF);

        function generatePDF() {
            const doc = new jsPDF();

            doc.setFontSize(16);
            doc.text('Đơn hàng của bạn gồm có:', 20, 20);
            doc.setFontSize(12);

            const tableData = [
                ['Mã hàng', 'Tên sản phẩm', 'Số lượng', 'Giá', 'Tổng tiền'],
                ['PROD001', 'T-shirt', '2', '$10.00', '$20.00'],
                ['PROD002', 'Jeans', '1', '$30.00', '$30.00']
            ];

            const tableX = 20;
            const tableY = 40;
            const tableWidth = 170;
            const rowHeight = 10;

            doc.autoTable({
                startY: tableY,
                head: [tableData[0]],
                body: tableData.slice(1),
                columnStyles: {
                    0: { cellWidth: 30 },
                    1: { cellWidth: 60 },
                    2: { cellWidth: 20, halign: 'right' },
                    3: { cellWidth: 30, halign: 'right' },
                    4: { cellWidth: 30, halign: 'right' }
                },
                styles: {
                    font: 'helvetica',
                    fontSize: 10,
                    overflow: 'linebreak',
                    cellPadding: 3
                }
            });

            doc.setFontSize(12);
            doc.text('Cảm ơn bạn đã đặt hàng tại website của chúng tôi.', 20, doc.lastAutoTable.finalY + 20);

            doc.save('don-hang.pdf');
        }
    </script>
</body>
</html>                                      