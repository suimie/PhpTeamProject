using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace ExportDB
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
        }

        private void btExportDB_Click(object sender, RoutedEventArgs e)
        {
            List<Product> productList = Database.getInstance().GetAllProducts();

            /*
            string insertLine = "INSERT INTO products " +
                "(id, pid, name, brand, category, price, description1, description2, imageType) " +
                "VALUES (";
            foreach(Product p in productList)
            {
                insertLine += (p.Id + ", " + p.Pid + ", " + p.Name + ", " + p.Brand + ", " + p.Category);
                insertLine += (p.Price + ", " + p.Description1 + ", " + p.Description2 + ", " + p.ImgType);
            }
            */
            string insertLine = "INSERT INTO Products " +
                "(supplierId, productName, description, price, inventoryOnHand, inventoryReceived, inventorySold, minInventoryLevel) " +
                "VALUES (";
            int count = 0;
            foreach (Product p in productList)
            {
                if (count != 0)
                    insertLine += ", (";
                insertLine += (p.Id + ", " + p.SupplierId + ", " + p.Name + ", " + p.Description + ", " + p.Price);
                insertLine += (p.OnHand + ", " + p.Received + ", " + p.Sold + ", " + p.MinLevel + ")");
            }
            try
            {
                File.WriteAllText("../../export.txt", insertLine);
            }catch (Exception ex)
            {
                MessageBox.Show("File Error");
            }
        }
    }
}
