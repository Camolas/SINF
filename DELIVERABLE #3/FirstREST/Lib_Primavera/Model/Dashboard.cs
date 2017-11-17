using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace FirstREST.Lib_Primavera.Model
{
    public class Dashboard
    {
        public List<Activity> today_agenda
        {
            get;
            set;
        }

        public List<Objectives> objectives
        {
            get;
            set;
        }
        public List<Statistics> statistics
        {
            get;
            set;
        }
    }
}
