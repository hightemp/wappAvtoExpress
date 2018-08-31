define(
  ['Vue', 'API'], 
  function(Vue, oAPI) 
  {
    return {
      namespaced: true,
      state: {
        iApplicationID: 0,
        oFields: {}
      },
      getters: {
        fnGetActiveFieldsValues(oState)
        {
          console.log('getters - fnGetActiveFieldsValues', oState['oFields']);
          var oResult = {};
          
          for (var sKey in oState['oFields']) {
            if (!oState['oFields'][sKey]['bDisabled']) {
              oResult[sKey] = {};
              oResult[sKey]['sField'] = oState['oFields'][sKey]['sField'];
              oResult[sKey]['sValue'] = oState['oFields'][sKey]['sValue'];
            }
          }
          
          return oResult;
        }
      },
      actions: {
        fnValidateField(oArguments, { oData, fnSuccess }) 
        {
          console.log('actions - fnValidateField', { oData, fnSuccess });
          oAPI.fnValidate(
            {
              sField: oData.sField,
              sValue: oData.sValue
            }, 
            fnSuccess
          );
        },
        fnUpdateField(oMethods, oArguments) 
        {
          console.log('actions - fnUpdateField', oArguments);
          oMethods.commit('UPDATE_FIELD', [oArguments.oData]);
        },
        fnPostNano(oMethods, oArguments) 
        {
          console.log('actions - fnPostNano');
          oAPI.fnPost(this.getters.fnGetActiveFieldsValues, "Nano", oArguments.fnSuccess);
        },
        fnPostShort(oMethods, oArguments) 
        {
          console.log('actions - fnPostShort');
          oAPI.fnPost(this.getters.fnGetActiveFieldsValues, "Short", oArguments.fnSuccess);
        },
        fnPostFull(oMethods, oArguments) 
        {
          console.log('actions - fnPostFull');
          oAPI.fnPost(this.getters.fnGetActiveFieldsValues, "Full", oArguments.fnSuccess);
        },
        fnGetApplicationData(oMethods, oArguments) 
        {
          console.log('actions - fnGetApplicationData');
          oAPI.fnGetApplicationData(
            oMethods.state.iApplicationID,
            function(oData)
            {
              for (var sKey in oData['data']) {
                oMethods.commit('UPDATE_FIELD', [oData['data'][sKey]]);
              }
              oArguments.fnSuccess(oData);
            }
          );
        },
        fnClearStorage(oMethods)
        {
          console.log('actions - fnClearStorage');
          localStorage.removeItem('oState');
        },
        fnSaveToStorage(oMethods)
        {
          console.log('actions - fnSaveToStorage');
          localStorage.setItem('oState', JSON.stringify(oMethods.state));
        },
        fnLoadFromStorage(oMethods)
        {
          console.log('actions - fnLoadFromStorage');
          var oStorageState = JSON.parse(localStorage.getItem('oState'));
          for (var sKey in oStorageState) {
            oMethods.commit('UPDATE_STATE', [oStorageState[sKey], sKey]);
          }
        }
      },
      mutations: {
        UPDATE_STATE(oState, aArguments) 
        {
          console.log('mutations - UPDATE_STATE', aArguments[0], aArguments[1]);
          
          if (oState[aArguments[1]] && typeof aArguments[0] == "object") {
            oState[aArguments[1]] = mergeObjects(oState[aArguments[1]], aArguments[0]);
          } else {
            oState[aArguments[1]] = aArguments[0];
          }
        },
        UPDATE_FIELD(oState, aArguments) 
        {
          console.log('mutations - UPDATE_FIELD', aArguments[0], aArguments[1]);
          
          if (aArguments[1] != undefined) {
            oState['oFields'][aArguments[1]] = aArguments[0];
          } else {
            oState['oFields'][aArguments[0].sField] = aArguments[0];
          }
          
          console.log('mutations - UPDATE_FIELD', JSON.stringify(oState));
        }
      }
    };
  }
);
