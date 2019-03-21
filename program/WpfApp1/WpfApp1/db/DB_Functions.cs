using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using WpfApp1.Model;

namespace WpfApp1.db
{
    class DB_Functions
    {
        static string host = "212.88.10.233";
        static int port = 3306;
        static string database = "projekt_sew";
        static string username = "pradmin";
        static string password = "htl";

        #region TestConnectDB
        public static bool TestconnectDB(string thost, int tport, string tdatabase, string tusername, string tpassword)
        {
            bool stat = false;
            String conString = "Server=" + thost + ";Database=" + tdatabase + ";port=" + tport + ";User Id=" + tusername + ";password=" + tpassword;
            MySqlConnection conn = new MySqlConnection();

            try
            {
                conn.ConnectionString = conString;
                conn.Open();
                stat = true;
            }
            catch (Exception e)
            {
                Console.WriteLine(e);
                stat = false;
            }
            finally
            {
                conn.Close();
            }

            return stat;
        }

        #endregion
        
        #region ConnectDB
        public static MySqlConnection connectDB()
        {
            String connString = "Server=" + host + ";Database=" + database + ";port=" + port + ";User Id=" + username + ";password=" + password;
            MySqlConnection conn = new MySqlConnection();

            try
            {
                conn.ConnectionString = connString;
                conn.Open();
            }
            catch (Exception e)
            {
                Console.WriteLine(e);
            }

            return conn;
        }

        #endregion

        public static ObservableCollection<Item> getItems()
        {
            ObservableCollection<Item> ListItems = new ObservableCollection<Item>();
            MySqlConnection con = connectDB();
            try
            {
                //hier auslesen
                MySqlCommand myCommand = new MySqlCommand("Select * from items", con);
                MySqlDataReader myReader = myCommand.ExecuteReader();
                while (myReader.Read())
                {
                    Item i = new Item((Int32)myReader["id"], (String)myReader["prefix"], (String)myReader["token"], (String)myReader["name"], (String)myReader["price"], (bool)myReader["isscanned"]);
                    ListItems.Add(i);
                }
            }
            catch (Exception e)
            {
                Console.WriteLine(e);
            }
            finally
            {
                con.Close();
            }
            return ListItems;
        }

    }
}
