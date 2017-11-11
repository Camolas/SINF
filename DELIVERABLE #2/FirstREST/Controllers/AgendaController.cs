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
        // GET: /agenda/
        public IEnumerable<Activity> Get()
        {
            return Lib_Primavera.PriIntegration.ListActivities();
        }

        // GET: /agenda/<activity_id>
        public Activity Get(string id)
        {
            Lib_Primavera.Model.Activity activity = Lib_Primavera.PriIntegration.GetActivity(id);
            if (activity == null)
            {
                throw new HttpResponseException(Request.CreateResponse(HttpStatusCode.NotFound));
            }
            else
            {
                return activity;
            }
        }

        public HttpResponseMessage Post(Activity activity)
        {
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            erro = Lib_Primavera.PriIntegration.InsertActivityObj(activity);
            if (erro.Erro == 0)
            {
                var response = Request.CreateResponse(HttpStatusCode.Created, activity);
                string uri = Url.Link("DefaultApi", new { activityId = activity.id });
                response.Headers.Location = new Uri(uri);
                return response;
            }
            else
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest);
            }
        }

        public HttpResponseMessage Put(string id, Activity activity)
        {
            activity.id = id;
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

        public HttpResponseMessage Delete(string id)
        {
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            try
            {
                erro = Lib_Primavera.PriIntegration.DelActivity(id);
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
