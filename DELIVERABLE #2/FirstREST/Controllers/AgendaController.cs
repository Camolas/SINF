using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using FirstREST.Lib_Primavera.Model;

namespace FirstREST.Controllers
{
    public class AgendaController : ApiController
    {
        // GET: /agenda/?representative_id=<representative_id>&month=<month>&year=<year>
        public IEnumerable<string> Get(string representative_id, string month, string year)
        {
            return Lib_Primavera.PriIntegration.ListActivities(representative_id, month, year);
        }

        // GET: /agenda/?representative_id=<representative_id>&date=<date>
        public IEnumerable<Activity> Get(string representative_id, string date)
        {
            return Lib_Primavera.PriIntegration.ListActivities(representative_id, date);
        }

        // POST: /agenda
        public HttpResponseMessage Post(Activity activity)
        {
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            erro = Lib_Primavera.PriIntegration.InsertActivityObj(activity);
            if (erro.Erro == 0)
            {
                var response = Request.CreateResponse(HttpStatusCode.Created, activity);
                string uri = Url.Link("DefaultApi", new { id = activity.id });
                response.Headers.Location = new Uri(uri);
                return response;
            }
            else
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, "It was not possible to create the appointment.");
            }
        }

        // PUT: /agenda/?activity_id=<activity_id>
        public HttpResponseMessage Put(string activity_id, Activity activity)
        {
            activity.id = activity_id;
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            try
            {
                erro = Lib_Primavera.PriIntegration.UpdActivity(activity);
                if (erro.Erro == 0)
                {
                    return Request.CreateResponse(HttpStatusCode.OK, erro.Descricao);
                }
                else
                {
                    return Request.CreateResponse(HttpStatusCode.NotFound, erro.Descricao);
                }
            }
            catch (Exception exc)
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, erro.Descricao);
            }
        }

        // DELETE: /agenda/?activity_id=<activity_id>
        public HttpResponseMessage Delete(string activity_id)
        {
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            try
            {
                erro = Lib_Primavera.PriIntegration.DelActivity(activity_id);
                if (erro.Erro == 0)
                {
                    return Request.CreateResponse(HttpStatusCode.OK, erro.Descricao);
                }
                else
                {
                    return Request.CreateResponse(HttpStatusCode.NotFound, erro.Descricao);
                }
            }
            catch (Exception exc)
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, erro.Descricao);
            }
        }
    }
}
