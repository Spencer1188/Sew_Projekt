using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using WpfApp1.db;
using WpfApp1.Model;

namespace WpfApp1.ViewModel
{
    class ViewModel
    {
        #region PropertyChanged
        public event PropertyChangedEventHandler PropertyChanged;
        protected internal void OnPropertyChanged(string propertyname)
        {
            if (PropertyChanged != null)
                PropertyChanged(this, new PropertyChangedEventArgs(propertyname));
        }
        #endregion

        private string status;
        private Item item;
        ObservableCollection<Item> listItems;
        public ViewModel()
        {
            //test connection
            //bool connstat = DB_Functions.connectDB("212.88.10.233", 3306,"projekt_sew","pradmin","htl");

            //Variablen anlegen
            ObservableCollection<Item> listItems = new ObservableCollection<Item>();
            ListItems = DB_Functions.getItems();
            item = new Item();

        }

        public string Status
        {
            set { status = value; OnPropertyChanged("Status"); }
            get { return status; }
        }

        public ObservableCollection<Item> ListItems
        {
            set
            {
                if (value != listItems)
                {
                    listItems = value;
                }
                OnPropertyChanged("ListItems");
            }
            get { return listItems; }
        }

        public String Name
        {
            set { item.Name = value; OnPropertyChanged("ProduktName"); }
            get { return item.Name; }
        }

    }
}
